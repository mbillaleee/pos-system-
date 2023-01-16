<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Purchases;
use App\Models\SaleExtra;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Product;
use App\Models\PurchaseExtra;
use App\Models\AccountTransection;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Auth;
use Datatables;
use Validator;
use Auth;
use DB;

class ReportController extends Controller
{
    public function purchasereport(Request $request)
    {
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 2){
            $user_id = $users->parent_id;
        }elseif($users->user_role == 4){
            $user_id = $users->parent_id;
        }
        // if(!empty($request->all())) {
            // dd($request->date_range);
        // }
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            $suppliers = Supplier::where('user_id',$user_id)->get();
            $purchases = Purchases::where('user_id',$user_id)->get();
            

            // dd($purchases);
            
            if(request()->ajax()) {
           
                if($request->supplier_id != null || $request->reference_num != null || $request->date_range != null || $request->payment_method !=null){
                    if($request->date_range != null){
                        $dt = explode(" - ",$request->date_range);
                        $from_date = date('Y-m-d', strtotime($dt[0]));
                        $to_date = date('Y-m-d', strtotime($dt[1]));
                        // dd($from_date);
                    }
                    $purchases = Purchases::where('user_id',$user_id)
                    ->where('supplier_id',$request->supplier_id)
                    ->where('reference_num',$request->reference_num)
                    ->whereBetween('purchase_date',[$from_date,$to_date])
                    ->where('payment_method',$request->payment_method)
                    ->get();
                   
                }else{
                    $purchases = Purchases::where('user_id',$user_id)->get();
                }
                return datatables()->of($purchases)
                ->addColumn('supplier_id', function($purchases){
                    return $purchases->suppliers['name'];
                 })
                 ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                    })
                ->addIndexColumn()
                ->make(true);
            }
        }else if($users->user_role == 3) {
            $suppliers = Supplier::all();
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
        return view('report/purchasereport', compact('suppliers', 'purchases'));
    }


    public function salereport()
    {
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 2){
            $user_id = $users->parent_id;
        }elseif($users->user_role == 4){
            $user_id = $users->parent_id;
        }
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            $sales = Sale::where('user_id',$user_id)->get();
            $customers = Customer::where('user_id',$user_id)->get();
            if(request()->ajax()) {
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
        
        return view('report/salereport', compact('sales', 'customers'));
    }


    public function saleinvoice($id)
    { 
        $sales = Sale::where('id',$id)->with('customers')->first();
        $sales_extra = SaleExtra::where('sale_id',$sales->id)->get();
        return view('report/saleinvoice', compact('sales','sales_extra'));
    }


    public function purchase_invoice($id)
    { 
        $purchases = Purchases::where('id',$id)->with('suppliers')->first();
        $purchase_extra = PurchaseExtra::where('purchase_id',$purchases->id)->get();
        return view('report/purchase-invoice', compact('purchases','purchase_extra'));
    }


    // public function ajax(Request $request)
    // {
    //     $purchases = Purchases::select(['purchase_date', 'supplier_id', 'reference_num', 'payment_method', 'due_amount', 'paid_amount', 'sub_total'])->get();
    //     return view('report/purchasereport', compact('purchases'));
    // }

}
