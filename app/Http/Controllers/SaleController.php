<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleExtra;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\AccountTransection;
use App\Models\Product;
use Illuminate\Http\Request;
use Datatables;
use Validator;
use Auth;
use DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();
   
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            if(request()->ajax()) {
                 $sales = Sale::where('shop_id',$users->shop_id)->get();
                // $sales = Sale::all();  //change korte hobe......
                return datatables()->of($sales)
                ->addColumn('customer_id', function($sales){
                    return $sales->customers['name'];
                 })
                ->addIndexColumn()
                ->make(true);
            }
        }else if($users->user_role == 3) {
            if(request()->ajax()) {
                $sales = Sale::all();
                return datatables()->of($sales)
                ->addColumn('customer_id', function($sales){
                    return $sales->customers['name'];
                 })
                ->addIndexColumn()
                ->make(true);  
            }
        }else{
            return redirect()->back();
        }
        
        return view('sale.index');
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
    
        if($users->user_role != 3){  //  if($users->user_role == 1 || $users->user_role == 3){
            $customers = Customer::where('shop_id',$users->shop_id)->get();
            $products = Product::where('shop_id',$users->shop_id)->get();
            return view('sale.create', compact('customers', 'products'));
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
        // dd($request->all());

        $users = Auth::user();
    
       $validator = Validator::make($request->all(), [
        'customer_id' => 'required|max:255',
        'reference_num' => 'nullable',
        'sale_date' => 'required',
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

    $sale= new Sale;
    $sale->user_id=$user_id;
    $sale->customer_id=$request->customer_id;
    $sale->reference_num=$request->reference_num;
    $sale->sale_date=$request->sale_date;
    $sale->payment_method=$request->payment_method;
    $sale->sub_total=$request->sub_total;
    $sale->discount_percent=$request->discount_percent;
    $sale->grand_total=$request->grand_total;
    $sale->paid_amount=$request->paid_amount;
    $sale->due_amount=$request->due_amount;
    $sale->note=$request->note;

    if($sale->save()){
        $id=$sale->id;
        foreach ($request->product_id as $key => $vl){
            $data = array(
                'sale_id'=>$id,
                'product_id'=>$vl,
                'quantity'=>$request->quantity [$key],
                'price'=>$request->price [$key],
                'total_amount'=>$request->total_amount [$key],

            );
            SaleExtra::insert($data);
        }
    
    $acctrans = new AccountTransection;
    $acctrans->vouch_no=$request->reference_num;
    $acctrans->vouch_date=$request->sale_date;
    $acctrans->chartofacc_id=6;
    $acctrans->credit=$request->grand_total; 
    $acctrans->customer_id=$request->customer_id;
    $acctrans->shop_id=$users->shop_id;
    $acctrans->save();

    if($request->due_amount>0 && $request->paid_amount>0){
    $acctrans2 = new AccountTransection;
    $acctrans2->vouch_no=$request->reference_num;
    $acctrans2->vouch_date=$request->sale_date;
    $acctrans2->chartofacc_id=$request->payment_method;
    $acctrans2->debit=$request->paid_amount;
    $acctrans2->customer_id=$request->customer_id;
    $acctrans2->shop_id=$users->shop_id;
    $acctrans2->save();

    $acctrans3 = new AccountTransection;
    $acctrans3->vouch_no=$request->reference_num;
    $acctrans3->vouch_date=$request->sale_date;
    $acctrans3->chartofacc_id=8;
    $acctrans3->debit=$request->due_amount;
    $acctrans3->customer_id=$request->customer_id;
    $acctrans3->shop_id=$users->shop_id;
    $acctrans3->save();
    }elseif($request->due_amount>0 && $request->paid_amount<1){
        $acctrans4 = new AccountTransection;
        $acctrans4->vouch_no=$request->reference_num;
        $acctrans4->vouch_date=$request->sale_date;
        $acctrans4->chartofacc_id=8;
        $acctrans4->debit=$request->due_amount;
        $acctrans4->customer_id=$request->customer_id;
        $acctrans4->shop_id=$users->shop_id;
        $acctrans4->save();
    }elseif($request->due_amount<1 && $request->paid_amount>0){
        $acctrans5 = new AccountTransection;
        $acctrans5->vouch_no=$request->reference_num;
        $acctrans5->vouch_date=$request->sale_date;
        $acctrans5->chartofacc_id=$request->payment_method;
        $acctrans5->debit=$request->paid_amount;
        $acctrans5->customer_id=$request->customer_id;
        $acctrans5->shop_id=$users->shop_id;
        $acctrans5->save();
    }
    }
    
    return redirect()->route('sale.index')->with('success','sale add successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
