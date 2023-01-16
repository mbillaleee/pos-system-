<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Takealot;
use App\Models\MyPos;
use App\Models\TakealotApi;
use App\Models\TakealotSale;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Imports\TakealotImport;
use Maatwebsite\Excel\Facades\Excel;

class TakealotController extends Controller
{
    public function index(){
        $users = Auth::user();
        if($users->user_role == 3){
            if(request()->ajax()) {
                return datatables()->of(Takealot::select('*'))
                ->addColumn('action', 'takealot.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }
        }else{
        if($users->user_role == 1){
            $user_id = $users->id;
        }else{
            $user_id = $users->parent_id;
        }

        if(request()->ajax()) {
            return datatables()->of(Takealot::select('*')->where('user_id',$user_id))
            ->addColumn('action', 'takealot.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    }
        $takealot_api = TakealotApi::where('user_id',$user_id)->latest()->first();
        return view('takealot.product',compact('takealot_api'));
    }

    public function edit(Request $request)
	{   
	    $where = array('id' => $request->id);
	    $takealots  = Takealot::where($where)->first();
	 
	    return Response()->json($takealots);
	}

    public function update(Request $request)
    {  
 
        $takealotId = $request->id;

        $takealots = Takealot::where('id', $takealotId)->update([
                    'sku' => $request->sku, 
                    'rrp' => $request->rrp,
                    'quantity' => $request->quantity,
                    'selling_price' => $request->selling_price
                ]); 
                         
        // Session::flash('success', 'Product updated successfully!');
        return Response()->json($takealots);
 
    }

    public function destroy(Request $request)
    {
        $takealots = Takealot::where('id',$request->id)->delete();

        return Response()->json($takealots);
    }


    public function api_update(Request $request)
    {  
        $takealotIds = $request->api_id;

        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 3){
            return redirect()->back()->with('error','You can not update!');
        }else{
            $user_id = $users->parent_id;
        }

        if($takealotIds != null){
            $takealots = TakealotApi::where('id', $takealotIds)->update([
                'api_key' => $request->api_key
            ]); 
            }else{
                $takealots = TakealotApi::create([
                    'api_key' => $request->api_key,
                    'user_id' => $user_id,
                ]); 
            }
                         
        return redirect()->back()->with('success','Api Key Updated Successfully!');
 
    }

    public function import()
    {
        Excel::import(new TakealotImport,request()->file('takealot_import'));
               
        return back()->with('success','Product Imported Successfully!');
    }

    public function report(Request $request){
        // dd($request->all());
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 3){
            return redirect()->back()->with('error','You can not See!');
        }else{
            $user_id = $users->parent_id;
        }
        if($request->sales_status == 'Top Selling Product'){
            $dt = explode(" - ",$request->date_range);

            $from_date = date('Y-m-d', strtotime($dt[0]));
            $to_date = date('Y-m-d', strtotime($dt[1]));
            $top_selling_product = TakealotSale::selectRaw('sum(quantity) as sale_item, sum(selling_price) as sale_price, product_name')->where('sale_status','!=','Returned')->whereBetween('order_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('user_id',$user_id)->groupBy('product_name')->orderBy('sale_item','desc')->get();
            $search_result = null;
            // $search_result = TakealotSale::where('sale_status','Shipped to Customer')->whereBetween('order_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('user_id',$user_id)->latest()->get();
            $selling_price = 0;
            foreach($top_selling_product as $sr){
                $selling_price += $sr->sale_price;
            }
        }elseif($request->sales_status == 'Top Return Product'){
            $dt = explode(" - ",$request->date_range);
            $search_result = null;
            $from_date = date('Y-m-d', strtotime($dt[0]));
            $to_date = date('Y-m-d', strtotime($dt[1]));
            $top_selling_product = TakealotSale::selectRaw('sum(quantity) as sale_item, sum(selling_price) as sale_price, product_name')->where('sale_status','Returned')->whereBetween('order_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('user_id',$user_id)->groupBy('product_name')->orderBy('sale_item','desc')->get();
            // $search_result = TakealotSale::where('sale_status','Returned')->whereBetween('order_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('user_id',$user_id)->latest()->get();
            $selling_price = 0;
            foreach($top_selling_product as $sr){
                $selling_price += $sr->sale_price;
            }
        }elseif($request->sales_status){
        $dt = explode(" - ",$request->date_range);
        $top_selling_product = null;
        $from_date = date('Y-m-d', strtotime($dt[0]));
        $to_date = date('Y-m-d', strtotime($dt[1]));
        $search_result = TakealotSale::where('sale_status',$request->sales_status)->whereBetween('order_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->where('user_id',$user_id)->latest()->get();
        $selling_price = 0;
        foreach($search_result as $sr){
            $selling_price += $sr->selling_price;
        }
        }else{
            $top_selling_product = null;
            $search_result = null;
            $selling_price = 0;
        }
        if($request->sales_status){
            $status = $request->sales_status;
        }else{
            $status = null;
        }
        if($request->date_range){
            $drange = $request->date_range;
        }else{
            $drange = null;
        }
        


        $sales_status = TakealotSale::select('sale_status')->groupBy('sale_status')->orderBy('sale_status','desc')->get();

        return view('takealot.report',compact('sales_status','search_result','drange','status','selling_price','top_selling_product'));
    }

    public function profit_calculation(){

        return view('takealot.profit_calculation');
    }

    public function product_sync()
    {
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 3){
            return redirect()->back()->with('error','You can not sync!');
        }else{
            $user_id = $users->parent_id;
        }
    // $url = "https://seller-api.takealot.com/v2/offers/offer";
    // $response = Http::get('https://seller-api.takealot.com/v2/offers/count', [
    //     'apiKey' => 'b61a80dfaa06c34ea7a16927295c2d0de7022f0c2ae57bec9eed18da3d52d0e4ee024a8deb0cd96bcd315ae5352a619c4bbb89b36307d8ec9ff866388fb5c320',
    //      'limit' => 10,
    // ]);
    $api_take = TakealotApi::where('user_id',$user_id)->latest()->first();
        if($api_take){
    $tapi = $api_take->api_key;
                                
    $count = "https://seller-api.takealot.com/v2/offers/count";
    $requestHeaders1 = array(
        'Content-Type: application/json',
        'Authorization: Key '.$tapi,
        'user-agent: Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36'
    ); 
    $curl1 = curl_init( $count );
    curl_setopt($curl1, CURLOPT_HTTPHEADER,$requestHeaders1);
    curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
    $json_response1 = curl_exec($curl1);
    curl_close($curl1);
    $result1 = json_decode($json_response1, TRUE);
    //  dd($json_response1);
    //echo $result1['count'];
    if ($result1['count'] > 0) {
        $pages = ceil($result1['count'] / 100);
        for ($i=0; $i<$pages; $i++) {
        
            $url ="https://seller-api.takealot.com/v2/offers?page_size=100&page_number=".($i+1);
            $requestHeaders = array(
                'Content-Type: application/json',
                'Authorization: Key '.$tapi,
                'user-agent: Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36'
            ); 
            $curl = curl_init( $url );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $requestHeaders);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $json_response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($json_response, TRUE);
            // dd($result);
                        
            foreach($result['offers'] as $product){   
                // dd($product['leadtime_stock']);
                $exist_data = Takealot::where('tsin',$product['tsin_id'])->where('user_id',$user_id)->first();
                if($exist_data == null){
                    $takealots = new Takealot;
                    $takealots->tsin = $product['tsin_id'];
                    $takealots->offer_id = $product['offer_id'];
                    $takealots->title = $product['title'];
                    $takealots->selling_price = $product['selling_price'];
                    $takealots->rrp = $product['rrp'];
                    if(isset($product['leadtime_stock'][0]['quantity_available'])){
                    $takealots->quantity = $product['leadtime_stock'][0]['quantity_available'];
                    }else {
                        $takealots->quantity = 0;
                    }
                    $takealots->sku = $product['sku'];
                    $takealots->barcode = $product['barcode'];
                    $takealots->status = $product['status'];
                    $takealots->takealot_url = $product['offer_url'];
                    $takealots->user_id = $user_id;
                    $takealots->save();
                }

            }
        }
    }

     return redirect()->back()->with('success','Product sync successfully!');
}else{
    return redirect()->back()->with('error','Product Api Key not found!');
}
    }


    public function update_qty() {

        return view('takealot.update_qty'); 
    }

    public function update_qty_up() {
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 3){
            return redirect()->back()->with('error','You can not update!');
        }else{
            $user_id = $users->parent_id;
        }
        $mypos_data_takealot = MyPos::where('user_id',$user_id)->where('tsin','!=',Null)->get();

        foreach($mypos_data_takealot as $mpos) {
           
            $takealots = Takealot::where('tsin',$mpos->tsin)->first();
            if($takealots != null){
                $takealots->quantity = $mpos->quantity;
                $takealots->update();
            }
        }

        return redirect()->back()->with('success','Quantity updated from pos data successfully!');
    }

    
}
