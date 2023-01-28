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
use App\Models\SaleVariant;
use App\Models\PurchaseVariant;
use App\Models\AccountTransection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Datatables;
use Validator;
use Auth;

class ReportController extends Controller
{
    public function purchasereport(Request $request)
    {
        $users = Auth::user();
      
    
        // dd($request->all());
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            $suppliers = Supplier::where('shop_id',$users->shop_id)->get();
            
            if($request->supplier_id != null && $request->reference_num != null){
              
                $dt = explode(" - ",$request->date_range);
                $search_result = null;
                $from_date = date('Y-m-d', strtotime($dt[0]));
                $to_date = date('Y-m-d', strtotime($dt[1]));
                $purchases = Purchases::where('supplier_id',$request->supplier_id)->where('reference_num',$request->reference_num)->whereBetween('purchase_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('shop_id',$users->shop_id)->get();
                
            }elseif($request->supplier_id){
              
                $dt = explode(" - ",$request->date_range);
                $search_result = null;
                $from_date = date('Y-m-d', strtotime($dt[0]));
                $to_date = date('Y-m-d', strtotime($dt[1]));
                $purchases = Purchases::where('supplier_id',$request->supplier_id)->whereBetween('purchase_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('shop_id',$users->shop_id)->get();
              
            }elseif($request->reference_num != null){
              
                $dt = explode(" - ",$request->date_range);
                $search_result = null;
                $from_date = date('Y-m-d', strtotime($dt[0]));
                $to_date = date('Y-m-d', strtotime($dt[1]));
                $purchases = Purchases::where('reference_num',$request->reference_num)->whereBetween('purchase_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('shop_id',$users->shop_id)->get();
              
            }else{
                $purchases = Purchases::where('shop_id',$users->shop_id)->get();
            }
            if($request->supplier_id){
                $supplier_id = $request->supplier_id;
            }else{
                $supplier_id = null;
            }
            if($request->reference_num){
                $reference_num = $request->reference_num;
            }else{
                $reference_num = null;
            }
            if($request->date_range){
                $drange = $request->date_range;
            }else{
                $drange = null;
            }




        }else if($users->user_role == 3) {
            $purchases = Purchases::all();
        }else{
                return redirect()->back(); 
            }



        return view('report/purchasereport', compact('suppliers', 'purchases'));
    }


    public function salereport(Request $request)
    {
        $users = Auth::user();
      
        // dd($request->all());
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            $customers = Customer::where('shop_id',$users->shop_id)->get();
            
            if($request->customer_id != null && $request->reference_num != null){
              
                $dt = explode(" - ",$request->date_range);
                $search_result = null;
                $from_date = date('Y-m-d', strtotime($dt[0]));
                $to_date = date('Y-m-d', strtotime($dt[1]));
                $sales = Sale::where('customer_id',$request->customer_id)->where('reference_num',$request->reference_num)->whereBetween('sale_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('shop_id',$users->shop_id)->get();
                
            }elseif($request->customer_id){
              
                $dt = explode(" - ",$request->date_range);
                $search_result = null;
                $from_date = date('Y-m-d', strtotime($dt[0]));
                $to_date = date('Y-m-d', strtotime($dt[1]));
                $sales = Sale::where('customer_id',$request->customer_id)->whereBetween('sale_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('shop_id',$users->shop_id)->get();
                
            }elseif($request->reference_num != null){
              
                $dt = explode(" - ",$request->date_range);
                $search_result = null;
                $from_date = date('Y-m-d', strtotime($dt[0]));
                $to_date = date('Y-m-d', strtotime($dt[1]));
                $sales = Sale::where('reference_num',$request->reference_num)->whereBetween('sale_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('shop_id',$users->shop_id)->get();
               
            }else{
                $sales = Sale::where('shop_id',$users->shop_id)->get();
            }
            if($request->customer_id){
                $customer_id = $request->customer_id;
            }else{
                $customer_id = null;
            }
            if($request->reference_num){
                $reference_num = $request->reference_num;
            }else{
                $reference_num = null;
            }
            if($request->date_range){
                $drange = $request->date_range;
            }else{
                $drange = null;
            }


        }else if($users->user_role == 3) {
            $sales = Sale::all();
        }else{
                return redirect()->back(); 
            }


        
        return view('report/salereport', compact('customers', 'sales'));
    }


    public function saleinvoice($id) 
    { 
        $users = Auth::user();
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











    public function toppurchasereport(Request $request)
    {
        $users = Auth::user();
      

        // dd($request->all());
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            if(request()->ajax()) {
                $purchases = Purchases::select([DB::raw('sum(purchase_extras.quantity) AS quantity'),DB::raw('sum(purchase_extras.total_amount) AS total_amount'),'purchase_extras.product_id as product_id'])
                ->join('purchase_extras','purchase_extras.purchase_id','=','purchases.id')
                ->where('purchases.shop_id',$users->shop_id)
                ->groupBy(DB::raw('purchase_extras.product_id'))->orderBy('quantity', 'DESC');;
     
                return datatables()->of($purchases)
                ->addColumn('product_id', function($purchases){
                    return $purchases->products['name'];
                 })
                 
                ->filter(function ($purchases) use ($request) {
                    if (!empty($request->get('supplier_id'))) {
                        $purchases->where('purchases.supplier_id', $request->get('supplier_id'));
                    }
                    if (!empty($request->get('purchase_date'))) {
                        $dt = explode(" - ",$request->get('purchase_date'));
                        $from_date = date('Y-m-d', strtotime($dt[0]));
                        $to_date = date('Y-m-d', strtotime($dt[1]));
                        $purchases->whereBetween('purchases.purchase_date', [date('Y-m-d', strtotime($from_date)), date('Y-m-d', strtotime($to_date))]);
                    }
                })
                // ->rawColumns(['supplier_id'])
                ->addIndexColumn()
                ->make(true);
            }
            $suppliers = Supplier::where('shop_id',$users->shop_id)->get();
        }else if($users->user_role == 3) {
            if(request()->ajax()) {
                $purchases = Purchases::select([DB::raw('sum(purchase_extras.quantity) AS quantity'),DB::raw('sum(purchase_extras.total_amount) AS total_amount'),'purchase_extras.product_id as product_id'])
                ->join('purchase_extras','purchase_extras.purchase_id','=','purchases.id')
                ->groupBy(DB::raw('purchase_extras.product_id'))->orderBy('quantity', 'DESC');;
     
                return datatables()->of($purchases)
                ->addColumn('product_id', function($purchases){
                    return $purchases->products['name'];
                 })
                 
                ->filter(function ($purchases) use ($request) {
                    if (!empty($request->get('supplier_id'))) {
                        $purchases->where('purchases.supplier_id', $request->get('supplier_id'));
                    }
                    if (!empty($request->get('purchase_date'))) {
                        $dt = explode(" - ",$request->get('purchase_date'));
                        $from_date = date('Y-m-d', strtotime($dt[0]));
                        $to_date = date('Y-m-d', strtotime($dt[1]));
                        $purchases->whereBetween('purchases.purchase_date', [date('Y-m-d', strtotime($from_date)), date('Y-m-d', strtotime($to_date))]);
                    }
                })
                // ->rawColumns(['supplier_id'])
                ->addIndexColumn()
                ->make(true);  
            }
            $suppliers = Supplier::all();
        }else{
            return redirect()->back();
        }

        
        
        return view('report.top-purchase',compact('suppliers'));

    }

    public function topsalereport(Request $request)
    {
        $users = Auth::user();
   
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            if(request()->ajax()) {
                //  $sales = Sale::where('shop_id',$users->shop_id)->latest();
                 $sales = Sale::select([DB::raw('sum(sale_extras.quantity) AS quantity'),DB::raw('sum(sale_extras.total_amount) AS total_amount'),'sale_extras.product_id as product_id'])
                 ->join('sale_extras','sale_extras.sale_id','=','sales.id')
                 ->where('sales.shop_id',$users->shop_id)
                 ->groupBy(DB::raw('sale_extras.product_id'))->orderBy('quantity', 'DESC');
      
                 return datatables()->of($sales)
                 ->addColumn('product_id', function($sales){
                     return $sales->products['name'];
                  })
                 ->filter(function ($sales) use ($request) {
                    if (!empty($request->get('customer_id'))) {
                        $sales->where('customer_id', $request->get('customer_id'));
                    }
                    if (!empty($request->get('sale_date'))) {
                        $dt = explode(" - ",$request->get('sale_date'));
                        $from_date = date('Y-m-d', strtotime($dt[0]));
                        $to_date = date('Y-m-d', strtotime($dt[1]));
                        $sales->whereBetween('sale_date', [date('Y-m-d', strtotime($from_date)), date('Y-m-d', strtotime($to_date))]);
                    }
                })
                ->addIndexColumn()
                ->make(true);
            }
            $customers = Customer::where('shop_id',$users->shop_id)->get();
        }else if($users->user_role == 3) {
            if(request()->ajax()) {
                //  $sales = Sale::where('shop_id',$users->shop_id)->latest();
                 $sales = Sale::select([DB::raw('sum(sale_extras.quantity) AS quantity'),DB::raw('sum(sale_extras.total_amount) AS total_amount'),'sale_extras.product_id as product_id'])
                 ->join('sale_extras','sale_extras.sale_id','=','sales.id')
                 ->groupBy(DB::raw('sale_extras.product_id'))->orderBy('quantity', 'DESC');
      
                 return datatables()->of($sales)
                 ->addColumn('product_id', function($sales){
                     return $sales->products['name'];
                  })
                 ->filter(function ($sales) use ($request) {
                    if (!empty($request->get('customer_id'))) {
                        $sales->where('customer_id', $request->get('customer_id'));
                    }
                    if (!empty($request->get('sale_date'))) {
                        $dt = explode(" - ",$request->get('sale_date'));
                        $from_date = date('Y-m-d', strtotime($dt[0]));
                        $to_date = date('Y-m-d', strtotime($dt[1]));
                        $sales->whereBetween('sale_date', [date('Y-m-d', strtotime($from_date)), date('Y-m-d', strtotime($to_date))]);
                    }
                })
                ->addIndexColumn()
                ->make(true);
            }
            $customers = Customer::all();
        }else{
            return redirect()->back();
        }
        
        return view('report.top-sale', compact('customers'));
        
    }


    


}
