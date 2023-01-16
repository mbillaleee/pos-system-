<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\ChartOfAccount;
use App\Models\AccountTransection;
use Datatables;
use Validator;
use Auth;
use DB;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 2){
            $user_id = $users->parent_id;
        }elseif($users->user_role == 4){
            $user_id = $users->parent_id;
        }
    // dd($product->categories['name']);
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            if(request()->ajax()) {
                $incomes = Income::all();
                return datatables()->of($incomes)
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }
        }else if($users->user_role == 3) {
            if(request()->ajax()) {
                $product = Product::with('categories')->with('brands');
                return datatables()->of($product)
                ->addColumn('category_id', function($product){
                    return $product->categories['name'];
                 })
                 ->addColumn('sub_category_id', function($product){
                    return $product->sub_categories['name'] ?? '';
                 })
                 ->addColumn('brand_id', function($product){
                    return $product->brands['name'];
                 })
                ->addColumn('action', function($product){
                   $btn = '<a href="'.route("product.edit",$product->id).'"data-original-title="Edit" class="text-primary mr-1 btn-sm detailProduct"><i class="fa-solid fa-pen-to-square"></i></a>';
                   $btn .= '<form class="d-inline" method="POST" action="'.route("product.destroy", $product->id).'"><input type="hidden" name="_method" value="delete" /><input type="hidden" name="_token" value="'. csrf_token() .'" /><button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button></form>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);  
            }
        }else{
            return redirect()->back();
        }
        
        return view('income.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 2){
            $user_id = $users->parent_id;
        }elseif($users->user_role == 4){
            $user_id = $users->parent_id;
        }
        if($users->user_role != 3){  //  if($users->user_role == 1 || $users->user_role == 3){
            $customers = Customer::where('user_id',$user_id)->get();
            $cartofacc = ChartOfAccount::where('parent_id',3)->get();
            // $purchases = Purchases::where('user_id',$user_id)->get();

            
            return view('income.create', compact('customers', 'cartofacc'));
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
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 2){
            $user_id = $users->parent_id;
        }elseif($users->user_role == 4){
            $user_id = $users->parent_id;
        }
        // $validator = Validator::make($request->all(), [
        //     'reference_num' => 'required',
        //     'customer_id' => 'required',
        //     'date' => 'required',
        //     'att_document' => 'nullable',
        //     'expense_type' => 'required',
        //     'payment_method' => 'required',
        //     'total_amount' => 'required',
        //     'paid_amount' => 'required',
            
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $income = New Income;
        $dccoment = $request->file('att_document');
        if($dccoment != '')
        {
            $dccomentname = pathinfo($dccoment->extension(), PATHINFO_FILENAME) . '-' . time() . '.' . $dccoment->extension();
            $dccoment->move(public_path('uploads/document/income'), $dccomentname);
            $income->att_document=$dccomentname;
        }

        $income->user_id=$user_id;
        $income->reference_num=$request->reference_num;
        $income->customer_id=$request->customer_id;
        $income->date=$request->date;
        // $income->att_document=$request->att_document;
        $income->income_type=$request->income_type;
        $income->payment_method=$request->payment_method;
        $income->total_amount=$request->total_amount;
        $income->paid_amount=$request->paid_amount;
        
        if($income->save()){
            $due_amount = $request->total_amount - $request->paid_amount;
            $acctrans = new AccountTransection;
            $acctrans->vouch_no=$request->reference_num;
            $acctrans->vouch_date=$request->date;
            $acctrans->chartofacc_id=$request->income_type;
            $acctrans->credit=$request->total_amount; 
            $acctrans->customer_id=$request->customer_id;
            $acctrans->user_id=$user_id;
            $acctrans->save();
            
            if($request->paid_amount>0 && $request->paid_amount < $request->total_amount){
                $acctrans2 = new AccountTransection;
                // dd($acctrans2->all());
            $acctrans2->vouch_no=$request->reference_num;
            $acctrans2->vouch_date=$request->date;
            $acctrans2->chartofacc_id=$request->payment_method;
            $acctrans2->debit=$request->paid_amount;
            $acctrans2->customer_id=$request->customer_id;
            $acctrans2->user_id=$user_id;
            $acctrans2->save();

            $acctrans3 = new AccountTransection;
            $acctrans3->vouch_no=$request->reference_num;
            $acctrans3->vouch_date=$request->date;
            $acctrans3->chartofacc_id=7;
            $acctrans3->credit=$due_amount;
            $acctrans3->customer_id=$request->customer_id;
            $acctrans3->user_id=$user_id;
            $acctrans3->save();

        }elseif($due_amount>0 && $request->paid_amount<1){
            $acctrans4 = new AccountTransection;
            $acctrans4->vouch_no=$request->reference_num;
            $acctrans4->vouch_date=$request->date;
            $acctrans4->chartofacc_id=7;
            $acctrans4->debit=$due_amount;
            $acctrans4->customer_id=$request->customer_id;
            $acctrans4->user_id=$user_id;
            $acctrans4->save();
        }elseif($due_amount<1 && $request->paid_amount>0){
            $acctrans5 = new AccountTransection;
            $acctrans5->vouch_no=$request->reference_num;
            $acctrans5->vouch_date=$request->date;
            $acctrans5->chartofacc_id=$request->payment_method;
            $acctrans5->debit=$request->paid_amount;
            $acctrans5->customer_id=$request->customer_id;
            $acctrans5->user_id=$user_id;
            $acctrans5->save();
        }
    }

        return redirect()->route('income.index')->with('success','income Insert successfully!');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}
