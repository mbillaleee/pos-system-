<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\TakealotSale;
use App\Models\TakealotApi;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Imports\TakealotSaleImport;
use Maatwebsite\Excel\Facades\Excel;

class TakealotSaleController extends Controller
{
    public function index(){
        $users = Auth::user();
        if($users->user_role == 3){
            if(request()->ajax()) {
                return datatables()->of(TakealotSale::select('*'))
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
            return datatables()->of(TakealotSale::select('*')->where('user_id',$user_id))
            ->addIndexColumn()
            ->make(true);
        }
    }
        $takealot_api = TakealotApi::where('user_id',$user_id)->latest()->first();
        return view('takealot.sales',compact('takealot_api'));
    }

    public function import()
    {
        Excel::import(new TakealotSaleImport,request()->file('takealotsale_import'));
               
        return back()->with('success','Sales Data Imported Successfully!');
    }

    public function sales_sync(){
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 3){
            return redirect()->back()->with('error','You can not sync!');
        }else{
            $user_id = $users->parent_id;
        }

        $api_take = TakealotApi::where('user_id',$user_id)->latest()->first();

        if($api_take){
        $tapi = $api_take->api_key;
          
        $count = "https://seller-api.takealot.com/v2/sales";
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
        //  dd($result1);
        // dd($result1['page_summary']['total']);
        if ($result1['page_summary']['total'] > 0) {
            $pages = ceil($result1['page_summary']['total'] / 100);
            for ($i=0; $i<$pages; $i++) {
                                        
                    $url ="https://seller-api.takealot.com/v2/sales?page_size=100&page_number=".($i+1);
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
         
                                                        
                    foreach($result['sales'] as $product){
                        $order_item_id = $product['order_item_id'];
                        $order_id = $product['order_id'];
                        $odate = $product['order_date'];
                            $newDate = date("Y/m/d", strtotime($odate));
                            $newTime = date("H:i:s", strtotime($odate));
                        $title = $product['product_title'];
                        $sprice = $product['selling_price'];
                        $qty = $product['quantity'];
                        $status = $product['sale_status'];
                        $cust_name = $product['customer'];
                        $dc = $product['dc'];
                        $tsin = $product['tsin'];
                                                            
                        $exist_data = TakealotSale::where('order_item_id',$order_item_id)->where('user_id',$user_id)->first();
                        if(isset($exist_data)){
                            $takealots = TakealotSale::findOrFail($exist_data->id);
                            $takealots->tsin = $tsin;
                            $takealots->sale_status = $status;
                            $takealots->update();
                        }else{
                            $takealots = new TakealotSale;
                            $takealots->tsin = $tsin;
                            $takealots->order_item_id = $order_item_id;
                            $takealots->order_id = $order_id;
                            $takealots->order_date = date("Y-m-d H:i:s", strtotime($odate));
                            $takealots->product_name = $title;
                            $takealots->selling_price = $sprice;
                            $takealots->quantity = $qty;
                            $takealots->cust_name = $cust_name;
                            $takealots->sale_status = $status;
                            $takealots->dc = $dc;
                            $takealots->user_id = $user_id;
                            $takealots->save();
                            
                        }
                    }
            }
        }
        return redirect()->back()->with('success','Sales sync successfully!');
    }else{
        return redirect()->back()->with('error','Takealot Api Key not found!');
    }
}
}
