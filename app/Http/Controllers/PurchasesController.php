<?php

namespace App\Http\Controllers;

use App\Models\Purchases; 
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseVariant;
use App\Models\ProductVariant;
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
                $purchases = Purchases::where('shop_id',$users->shop_id)->latest();
                return datatables()->of($purchases)
                ->addColumn('supplier_id', function($purchases){
                    return $purchases->suppliers['name'];
                 })
                 
                ->filter(function ($purchases) use ($request) {
                    if (!empty($request->get('supplier_id'))) {
                        $purchases->where('supplier_id', $request->get('supplier_id'));
                    }
                    if (!empty($request->get('reference_num'))) {
                        $purchases->where('reference_num', $request->get('reference_num'));
                    }
                    if (!empty($request->get('purchase_date'))) {
                        $dt = explode(" - ",$request->get('purchase_date'));
                        $from_date = date('Y-m-d', strtotime($dt[0]));
                        $to_date = date('Y-m-d', strtotime($dt[1]));
                        $purchases->whereBetween('purchase_date', [date('Y-m-d', strtotime($from_date)), date('Y-m-d', strtotime($to_date))]);
                    }
                })
                ->addColumn('action', function($purchases){
                    $btn = '<a href="'.route('purchase_invoice',$purchases->id).'" title="View" class="mr-1 btn-sm detailProduct"><i class="text-primary fa-solid fa-eye"></i></a>';
               
                    return $btn;
                })
                // ->rawColumns(['supplier_id'])
                ->addIndexColumn()
                ->make(true);
            }
        }else if($users->user_role == 3) {
            if(request()->ajax()) {
                $purchases = Purchases::latest();
                return datatables()->of($purchases)
                ->addColumn('supplier_id', function($purchases){
                    return $purchases->suppliers['name'];
                 })
                 ->filter(function ($purchases) use ($request) {
                    if (!empty($request->get('supplier_id'))) {
                        $purchases->where('supplier_id', $request->get('supplier_id'));
                    }
                })
                // ->rawColumns(['supplier_id'])
                ->addIndexColumn()
                ->make(true);  
            }
        }else{
            return redirect()->back();
        }

        $suppliers = Supplier::where('shop_id',$users->shop_id)->get();
        
        return view('purchase.index',compact('suppliers'));
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
            // $variable_product = ProductVariantValue::where('product_id',$id)->get();
            
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
        'reference_num' => 'required|max:255',
        'purchase_date' => 'required',
        'payment_method' => 'required|max:255',
    //     'sub_total' => 'required|max:255',
    //     'discount_percent' => 'nullable|max:255',
    //     'grand_total' => 'required|max:255',
        // 'paid_amount' => 'nullable|max:255',
    //     'due_amount' => 'nullable|max:255',
    //     'note' => 'nullable|max:255',
    //     'product_id[]' => 'nullable|max:255',
    //     'quantity[]' => 'nullable|max:255',
    //     'price[]' => 'nullable|max:255',
    //     'total_amount[]' => 'nullable|max:255',
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
            $pType = $request->product_type [$key];
            if($pType == 2){
                $data = array(
                    'purchase_id'=>$id,
                    'product_id'=>$vl,
                    'purchase_variants_id'=>$request->purchase_variants_id [$key]  ?? null,
                    'purchase_variants_value_id'=>$request->purchase_variants_value_id [$key]  ?? null,
                    'product_type'=>$pType,
                    'quantity'=>$request->quantity [$key],
                    'purchase_price'=>$request->purchase_price [$key],
                    'total_amount'=>$request->total_amount [$key],
    
                );
                PurchaseExtra::insert($data);
            }else{
                $data = array(
                    'purchase_id'=>$id,
                    'product_id'=>$vl,
                    'product_type'=>$pType,
                    'quantity'=>$request->quantity [$key],
                    'purchase_price'=>$request->purchase_price [$key],
                    'total_amount'=>$request->total_amount [$key],
    
                );
                PurchaseExtra::insert($data);
            }
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
        $data['product'] = Product::where('id',$request->id)->first();
        $data['variable'] = ProductVariant::where('product_id',$data['product']->id)->get();
        return response()->json($data); 
    }

    public function product_search(Request $request) {
        $data = Product::where('product_type','!=',3)
        ->where('name','LIKE','%'.$request->product_search."%")
        ->orWhere('sku','LIKE','%'.$request->product_search."%")
        ->orWhere('barcode','LIKE','%'.$request->product_search."%")
        ->get();
        
        return response()->json($data); 
    }

    public function product_variable_data(Request $request) {
        $data['product_val'] = Product::where('id', $request->id)->first();
        $data['variable_products'] = ProductVariant::where('product_id',$data['product_val']->id)->with('product_variants')->with('product_variant_values')->get();
        return response()->json($data); 
    }

    
}
