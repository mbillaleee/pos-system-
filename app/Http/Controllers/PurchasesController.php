<?php

namespace App\Http\Controllers;

use App\Models\Purchases;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseExtra;
use App\Models\AccountTransection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Validator;
// use Auth;
use DB;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $users = Auth::user();
      

        // dd($request->all());
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            if(request()->ajax()) {
                $purchases = Purchases::where('shop_id',$users->shop_id)->get();
                return datatables()->of($purchases)
                ->addColumn('supplier_id', function($purchases){
                    return $purchases->suppliers['name'];
                 })

                 ->filter(function ($instance) use ($request) {
                    // if ($request->has('supplier_id')) {
                    //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //         return Str::contains($row['supplier_id'], $request->get('supplier_id')) ? true : false;
                    //     });
                    // }
    
                    // if ($request->has('reference_num')) {
                    //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //         return Str::contains($row['reference_num'], $request->get('reference_num')) ? true : false;
                    //     });
                    // }
                    // if ($request->has('purchase_date')) {
                    //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //         return Str::contains($row['purchase_date'], $request->get('purchase_date')) ? true : false;
                    //     });
                    // }
                    // if ($request->has('payment_method')) {
                    //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //         return Str::contains($row['payment_method'], $request->get('payment_method')) ? true : false;
                    //     });
                    // }
                })

                ->addIndexColumn()
                ->make(true);
            }
        }else if($users->user_role == 3) {
            if(request()->ajax()) {
                $purchases = Purchases::all();
                return datatables()->of($purchases)
                ->addColumn('supplier_id', function($purchases){
                    return $purchases->suppliers['name'];
                 })
                ->addIndexColumn()
                ->make(true);  
            }
        }else{
            return redirect()->back();
        }
        
        return view('purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('ok');
        $users = Auth::user();
       
        if($users->user_role != 3){
            $suppliers = Supplier::where('shop_id',$users->shop_id)->get();
            $products = Product::where('shop_id',$users->shop_id)->get();
            return view('purchase.create', compact('suppliers', 'products'));
            // return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    dd($request->all());
    
    $users = Auth::user();
  
        // $user_id = Auth::user()->id;
        // $user_id = DB::table('users')->where('id',$request->id);

       $validator = Validator::make($request->all(), [
        'supplier_id' => 'required|max:255',
        'reference_num' => 'nullable',
        'purchase_date' => 'required',
        'payment_method' => 'required|max:255',
        'sub_total' => 'required|max:255',
        'discount_percent' => 'nullable|max:255',
        'grand_total' => 'required|max:255',
        'paid_amount' => 'nullable|max:255',
        'due_amount' => 'nullable|max:255',
        'note' => 'nullable|max:255',
        'product_id[]' => 'nullable|max:255',
        'quantity[]' => 'nullable|max:255',
        'price[]' => 'nullable|max:255',
        'total_amount[]' => 'nullable|max:255',
    ]);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $purchase= new Purchases;
    $purchase->shop_id=$users->shop_id;
    $purchase->supplier_id=$request->supplier_id;
    $purchase->reference_num=$request->reference_num;
    $purchase->purchase_date=$request->purchase_date;
    $purchase->payment_method=$request->payment_method;
    $purchase->sub_total=$request->sub_total;
    $purchase->discount_percent=$request->discount_percent;
    $purchase->grand_total=$request->grand_total;
    $purchase->paid_amount=$request->paid_amount;
    $purchase->due_amount=$request->due_amount;
    $purchase->note=$request->note;

    if($purchase->save()){
        $id=$purchase->id;
        foreach ($request->product_id as $key => $vl){ 
            $data = array(
                'purchase_id'=>$id,
                'product_id'=>$vl,
                'quantity'=>$request->quantity [$key],
                'price'=>$request->price [$key],
                'total_amount'=>$request->total_amount [$key],

            );
            PurchaseExtra::insert($data);
        }

        $acctrans = new AccountTransection;
        $acctrans->vouch_no=$request->reference_num;
        $acctrans->vouch_date=$request->purchase_date;
        $acctrans->chartofacc_id=5;
        $acctrans->debit=$request->grand_total;
        $acctrans->supplier_id=$request->supplier_id;
        $acctrans->shop_id=$users->shop_id;
        $acctrans->save();

        if($request->due_amount>0 && $request->paid_amount>0){
        $acctrans2 = new AccountTransection;
        $acctrans2->vouch_no=$request->reference_num;
        $acctrans2->vouch_date=$request->purchase_date;
        $acctrans2->chartofacc_id=$request->payment_method;
        $acctrans2->credit=$request->paid_amount;
        $acctrans2->supplier_id=$request->supplier_id;
        $acctrans2->shop_id=$users->shop_id;
        $acctrans2->save();

        $acctrans3 = new AccountTransection;
        $acctrans3->vouch_no=$request->reference_num;
        $acctrans3->vouch_date=$request->purchase_date;
        $acctrans3->chartofacc_id=7;
        $acctrans3->credit=$request->due_amount;
        $acctrans3->supplier_id=$request->supplier_id;
        $acctrans3->shop_id=$users->shop_id;
        $acctrans3->save();
        }elseif($request->due_amount>0 && $request->paid_amount<1){
            $acctrans4 = new AccountTransection;
            $acctrans4->vouch_no=$request->reference_num;
            $acctrans4->vouch_date=$request->purchase_date;
            $acctrans4->chartofacc_id=7;
            $acctrans4->credit=$request->due_amount;
            $acctrans4->supplier_id=$request->supplier_id;
            $acctrans4->shop_id=$users->shop_id;
            $acctrans4->save();
        }elseif($request->due_amount<1 && $request->paid_amount>0){
            $acctrans5 = new AccountTransection;
            $acctrans5->vouch_no=$request->reference_num;
            $acctrans5->vouch_date=$request->purchase_date;
            $acctrans5->chartofacc_id=$request->payment_method;
            $acctrans5->credit=$request->paid_amount;
            $acctrans5->supplier_id=$request->supplier_id;
            $acctrans5->shop_id=$users->shop_id;
            $acctrans5->save();
        }
    }

    return redirect()->route('purchase.index')->with('success','Purchase Insert successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function show(Purchases $purchases)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchases $purchases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchases $purchases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchases $purchases)
    {
        //
    }

    public function productPrice(Request $request) {
        $data = Product::where('id',$request->id)->first();
        return response()->json($data);
    }
}
