<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopifySale;
use App\Models\ShopifyApi;
use App\Models\ShopifySaleDetail;
use App\Models\ShopifySaleRefund;
use Illuminate\Support\Facades\Auth;
use Datatables;
// use App\Imports\ShopifySaleImport;
use Maatwebsite\Excel\Facades\Excel;

class ShopifySaleController extends Controller
{
    public function index(){
        $users = Auth::user();
        if($users->user_role == 3){
            if(request()->ajax()) {
                return datatables()->of(ShopifySale::select('*'))
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
            return datatables()->of(ShopifySale::select('*')->where('user_id',$user_id))
            ->addIndexColumn()
            ->make(true);
        }
    }
        $shopify_api = ShopifyApi::where('user_id',$user_id)->latest()->first();
        return view('shopify.sales',compact('shopify_api'));
    }

    // public function import()
    // {
    //     Excel::import(new TakealotSaleImport,request()->file('takealotsale_import'));
               
    //     return back()->with('success','Sales Data Imported Successfully!');
    // }


    public function sales_sync(){
    
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 3){
            return redirect()->back()->with('error','You can not sync!');
        }else{
            $user_id = $users->parent_id;
        }
        
        $api_take = ShopifyApi::where('user_id',$user_id)->latest()->first();
    
        if($api_take){
        $api = $api_take->api;
        $password = $api_take->password;
        $shopurl = $api_take->url;
       
        $items_per_page = 250;
        $merged = array();
        $next_page = '';
        $last_page = false;
        
    while(!$last_page) 
    {   
        if($next_page == '')
        {
            $url = "https://".$api.":".$password."@".$shopurl."/admin/orders.json?status=any&limit=" . $items_per_page; // . '&fields=';
        }
        else
        {
            $url = "https://".$api.":".$password."@".$shopurl."/admin/orders.json?limit=" . $items_per_page . $next_page; // . '&fields=';
        }
        $headers = array();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_HEADERFUNCTION, function($curl, $header) use (&$headers) {
            $len = strlen($header);
            $header = explode(':', $header, 2);
            if (count($header) >= 2) {
                $headers[strtolower(trim($header[0]))] = trim($header[1]);
            }
            return $len;
        });
        $result = curl_exec($curl);
        curl_close($curl);
        if(isset($headers['link'])) 
        {
            $links = explode(',', $headers['link']);
        	foreach($links as $link) 
        	{
        	    $last_page = false;
        		if(strpos($link, 'rel="next"')) 
        		{
        		    preg_match('~<(.*?)>~', $link, $next);
        			$url_components = parse_url($next[1]);
        			parse_str($url_components['query'], $params);
        			$next_page = '&page_info=' . $params['page_info'];
        		} else {
        			$last_page = true;
        	    }
            }
        } else {
            $last_page = true; // if missing "link" parameter - there's only one page of results = last_page
        }
        $source_array = json_decode($result, true);
        $merged = array_merge_recursive($merged, $source_array);
           
    } 
                // dd($merged['orders']);       
    foreach($merged['orders'] as $product)
    {
        $contlineitems = count($product['line_items']);
        if($product['refunds'] != null){
        $countrefunditems = count($product['refunds'][0]['refund_line_items']);
        }else{
            $countrefunditems = 0;
        }
        // dd($product);
                                    
        $orderid = $product['id'];
        $createdate = $product['created_at'];
            $explodecreatedate = explode("T",$createdate);
            $explodedate = $explodecreatedate[0];
                $explodetime = explode("+",$explodecreatedate[1]);
                    $exploadtimevalue = $explodetime[0];
        $sales_date = $explodedate . ' ' . $exploadtimevalue;
        if(isset($product['customer']) && $product['customer'] != null) {
            $firstname = $product['customer']['first_name'];
        }else{
            $firstname = null;
        }
        if(isset($product['customer']) && $product['customer'] != null) {
            $lastname = $product['customer']['last_name'];
        }else{
            $lastname = null;
        }
        $subtotal = $product['subtotal_price'];
        $financialstatus = $product['financial_status'];
        $fulfillment_status = $product['fulfillment_status'];
        $gateway = $product['gateway'];
        
        //shipping details
        if(isset($product['shipping_address']) && $product['shipping_address'] != null) {
            $shipping_name = $product['shipping_address']['name'];
        }else{
            $shipping_name = null;
        }
        if(isset($product['shipping_address']) && $product['shipping_address'] != null) {
            $shipping_address1 = $product['shipping_address']['address1'];
        }else{
            $shipping_address1 = null;
        }
        if(isset($product['shipping_address']) && $product['shipping_address'] != null) {
            $shipping_address2 = $product['shipping_address']['address2'];
        }else{
            $shipping_address2 = null;
        }
        if(isset($product['shipping_address']) && $product['shipping_address'] != null) {
            $shipping_city = $product['shipping_address']['city'];
        }else{
            $shipping_city = null;
        }
        if(isset($product['shipping_address']) && $product['shipping_address'] != null) {
            $shipping_province = $product['shipping_address']['province'];
        }else{
            $shipping_province = null;
        }
        if(isset($product['shipping_address']) && $product['shipping_address'] != null) {
            $shipping_country = $product['shipping_address']['country'];
        }else{
            $shipping_country = null;
        }
        if(isset($product['shipping_address']) && $product['shipping_address'] != null) {
            $shipping_zip = $product['shipping_address']['zip'];
        }else{
            $shipping_zip = null;
        }
        if(isset($product['shipping_address']) && $product['shipping_address'] != null) {
            $shipping_phone = $product['shipping_address']['phone'];
        }else{
            $shipping_phone = null;
        }
        
        //billing details
        if(isset($product['billing_address']) && $product['billing_address'] != null) {
        $billing_name = $product['billing_address']['name'];
        }else{
            $billing_name = null;
        }
        if(isset($product['billing_address']) && $product['billing_address'] != null) {
        $billing_address1 = $product['billing_address']['address1'];
        }else{
            $billing_address1 = null;
        }
        if(isset($product['billing_address']) && $product['billing_address'] != null) {
        $billing_address2 = $product['billing_address']['address2'];
        }else{
            $billing_address2 = null;
        }
        if(isset($product['billing_address']) && $product['billing_address'] != null) {
        $billing_city = $product['billing_address']['city'];
        }else{
            $billing_city = null;
        }
        if(isset($product['billing_address']) && $product['billing_address'] != null) {
        $billing_province = $product['billing_address']['province'];
        }else{
            $billing_province = null;
        }
        if(isset($product['billing_address']) && $product['billing_address'] != null) {
        $billing_country = $product['billing_address']['country'];
        }else{
            $billing_country = null;
        }
        if(isset($product['billing_address']) && $product['billing_address'] != null) {
        $billing_zip = $product['billing_address']['zip'];
        }else{
            $billing_zip = null;
        }
        if(isset($product['billing_address']) && $product['billing_address'] != null) {
        $billing_phone = $product['billing_address']['phone'];
        }else{
            $billing_phone = null;
        }
        
        if($countrefunditems > 0)
        {
            $y=0; $refundtotalamount=0; 
            while($y < $countrefunditems)
            { 
                //echo $product['refunds'][0]['refund_line_items'];
                $shopifyrefundid = $product['refunds'][0]['refund_line_items'][$y]['id'];

                $refunditemtitle = $product['refunds'][0]['refund_line_items'][$y]['line_item']['title'];
                $refunditemprice = $product['refunds'][0]['refund_line_items'][$y]['line_item']['price'];
                $refunditemqty = number_format($product['refunds'][0]['refund_line_items'][$y]['quantity'],2);
                $refunditemtotal = $refunditemprice * $refunditemqty;
                                                
                $refundtotalamount += $refunditemtotal;
                $ssrefundquery = ShopifySaleRefund::where('sales_id',$orderid)->where('refund_id',$shopifyrefundid)->where('user_id',$user_id)->first();
                // dd($ssrefundquery);
                // execquery("SELECT * FROM `salesshopify_refund` WHERE `sales_id`='$orderid' AND `refund_id`='$shopifyrefundid' AND `user_id`='$userid'");
                if($ssrefundquery == null){
                    $ssrefundinsert = New ShopifySaleRefund;
                    $ssrefundinsert->sales_id = $orderid;
                    $ssrefundinsert->refund_id = $shopifyrefundid;
                    $ssrefundinsert->product_name = $refunditemtitle;
                    $ssrefundinsert->product_price = $refunditemprice;
                    $ssrefundinsert->quantity = $refunditemqty;
                    $ssrefundinsert->product_total = $refunditemtotal;
                    $ssrefundinsert->user_id = $user_id;
                    $ssrefundinsert->save();
                    // $ssrefundinsert = execquery("INSERT INTO `salesshopify_refund`(`sales_id`, `refund_id`, `product_name`, `product_price`, `quantity`, `product_total`, `user_id`) VALUES ('$orderid','$shopifyrefundid','$refunditemtitle','$refunditemprice','$refunditemqty','$refunditemtotal','$userid')");
                }
                else
                {
                    $sslineitemsupdate = ShopifySaleRefund::findOrFail($ssrefundquery->id);
                    $sslineitemsupdate->product_name = $refunditemtitle;
                    $sslineitemsupdate->product_price = $refunditemprice;
                    $sslineitemsupdate->quantity = $refunditemqty;
                    $sslineitemsupdate->product_total = $refunditemtotal;
                    $sslineitemsupdate->update();
                    // $sslineitemsupdate = execquery("UPDATE `salesshopify_refund` SET `product_name`='$refunditemtitle',`product_price`='$refunditemprice',`quantity`='$refunditemqty',`product_total`='$refunditemtotal' WHERE `sales_id`='$orderid' AND `refund_id`='$shopifyrefundid' AND `user_id`='$userid'");
                }
                $y++; 
            }
        }else{ $refundtotalamount=0; }
                                    
                                                
        $x=0; $lineitemtotalamount=0; 
        while($x < $contlineitems)
        {
            $shopifylineitemsid = $product['line_items'][$x]['id'];
            $lineitemtitle = $product['line_items'][$x]['title'];
            $lineitemprice = $product['line_items'][$x]['price'];
            $lineitemqty = number_format($product['line_items'][$x]['quantity'],2);
            $lineitemtotal = $lineitemprice * $lineitemqty;
                                                
            $lineitemtotalamount += $lineitemtotal;
            $sslineitemsquery = ShopifySaleDetail::where('sales_id',$orderid)->where('lineitems_id',$shopifylineitemsid)->where('user_id',$user_id)->first();
            // $sslineitemsquery = execquery("SELECT * FROM `salesshopify_details` WHERE `sales_id`='$orderid' AND `lineitems_id`='$shopifylineitemsid' AND `user_id`='$userid'");
            if($sslineitemsquery == null){
                $sslineitemsinsert = new ShopifySaleDetail;
                $sslineitemsinsert->sales_id = $orderid;
                $sslineitemsinsert->lineitems_id = $shopifylineitemsid;
                $sslineitemsinsert->product_name = $lineitemtitle;
                $sslineitemsinsert->product_price = $lineitemprice;
                $sslineitemsinsert->quantity = $lineitemqty;
                $sslineitemsinsert->product_total = $lineitemtotal;
                $sslineitemsinsert->user_id = $user_id;
                $sslineitemsinsert->save();
                
                // execquery("INSERT INTO `salesshopify_details`(`sales_id`, `lineitems_id`, `product_name`, `product_price`, `quantity`, `product_total`, `user_id`) VALUES ('$orderid','$shopifylineitemsid','$lineitemtitle','$lineitemprice','$lineitemqty','$lineitemtotal','$userid')");
            }
            else
            {
                    $sslineitemsupdate = ShopifySaleDetail::findOrFail($sslineitemsquery->id);
                    $sslineitemsupdate->product_name = $lineitemtitle;
                    $sslineitemsupdate->product_price = $lineitemprice;
                    $sslineitemsupdate->quantity = $lineitemqty;
                    $sslineitemsupdate->product_total = $lineitemtotal;
                    $sslineitemsupdate->update();
                // $sslineitemsupdate = execquery("UPDATE `salesshopify_details` SET `product_name`='$lineitemtitle',`product_price`='$lineitemprice',`quantity`='$lineitemqty',`product_total`='$lineitemtotal' WHERE `sales_id`='$orderid' AND `lineitems_id`='$shopifylineitemsid' AND `user_id`='$userid'");
            }
            $x++; 
        }

        $salestotalamount = $subtotal-$refundtotalamount;
        $query = ShopifySale::where('sales_id',$orderid)->where('user_id',$user_id)->first();
        
        // execquery("SELECT * FROM `salesshopify` where sales_id='$orderid' AND `user_id`='$userid'");
        if($query == null){
            $shopifysalesquery = new ShopifySale;
            $shopifysalesquery->sales_id = $orderid;
            $shopifysalesquery->sales_date = $sales_date;
            $shopifysalesquery->cust_firstname = $firstname;
            $shopifysalesquery->cust_lastname = $lastname;
            $shopifysalesquery->total_amount = $salestotalamount;
            $shopifysalesquery->sales_status = $financialstatus;
            $shopifysalesquery->payment_method = $gateway;

            $shopifysalesquery->shipping_name = $shipping_name;
            $shopifysalesquery->shipping_address1 = $shipping_address1;
            $shopifysalesquery->shipping_address2 = $shipping_address2;
            $shopifysalesquery->shipping_city = $shipping_city;
            $shopifysalesquery->shipping_province = $shipping_province;
            $shopifysalesquery->shipping_country = $shipping_country;
            $shopifysalesquery->shipping_zip = $shipping_zip;
            $shopifysalesquery->shipping_phone = $shipping_phone;

            $shopifysalesquery->billing_name = $billing_name;
            $shopifysalesquery->billing_address1 = $billing_address1;
            $shopifysalesquery->billing_address2 = $billing_address2;
            $shopifysalesquery->billing_city = $billing_city;
            $shopifysalesquery->billing_province = $billing_province;
            $shopifysalesquery->billing_country = $billing_country;
            $shopifysalesquery->billing_zip = $billing_zip;
            $shopifysalesquery->billing_phone = $billing_phone;

            $shopifysalesquery->collectno = null;
            $shopifysalesquery->waybillno = null;
            $shopifysalesquery->booking_status = $fulfillment_status;
            $shopifysalesquery->user_id = $user_id;
            $shopifysalesquery->save();
            
            // execquery("INSERT INTO `salesshopify`(`sales_id`, `sales_date`, `sales_time`, `cust_firstname`, `cust_lastname`, `total_amount`, `sales_status`, `payment_method`, `user_id`, `shipping_name`, `shipping_address1`, `shipping_address2`, `shipping_city`, `shipping_province`, `shipping_country`, `shipping_zip`, `shipping_phone`, `billing_name`, `billing_address1`, `billing_address2`, `billing_city`, `billing_province`, `billing_country`, `billing_zip`, `billing_phone`, `collectno`, `waybillno`, `booking_status`) VALUES 
            // ('$orderid','$explodedate','$exploadtimevalue','$firstname','$lastname','$salestotalamount','$financialstatus','$gateway','$userid','$shipping_name',
            // '$shipping_address1','$shipping_address2','$shipping_city','$shipping_province','$shipping_country','$shipping_zip','$shipping_phone',
            // '$billing_name','$billing_address1','$billing_address2','$billing_city','$billing_province','$billing_country','$billing_zip','$billing_phone','','','$fulfillment_status')");
        }
        else
        {
            $shopifysalesupdate = ShopifySale::findOrFail($query->id);
            $shopifysalesupdate->total_amount = $salestotalamount;
            $shopifysalesupdate->sales_status = $financialstatus;
            $shopifysalesupdate->payment_method = $gateway;

            $shopifysalesupdate->shipping_name = $shipping_name;
            $shopifysalesupdate->shipping_address1 = $shipping_address1;
            $shopifysalesupdate->shipping_address2 = $shipping_address2;
            $shopifysalesupdate->shipping_city = $shipping_city;
            $shopifysalesupdate->shipping_province = $shipping_province;
            $shopifysalesupdate->shipping_country = $shipping_country;
            $shopifysalesupdate->shipping_zip = $shipping_zip;
            $shopifysalesupdate->shipping_phone = $shipping_phone;

            $shopifysalesupdate->billing_name = $billing_name;
            $shopifysalesupdate->billing_address1 = $billing_address1;
            $shopifysalesupdate->billing_address2 = $billing_address2;
            $shopifysalesupdate->billing_city = $billing_city;
            $shopifysalesupdate->billing_province = $billing_province;
            $shopifysalesupdate->billing_country = $billing_country;
            $shopifysalesupdate->billing_zip = $billing_zip;
            $shopifysalesupdate->billing_phone = $billing_phone;

            $shopifysalesupdate->booking_status = $fulfillment_status;

            $shopifysalesupdate->update();
            // $shopifysalesupdate = execquery("UPDATE `salesshopify` SET `total_amount`='$salestotalamount',`sales_status`='$financialstatus',`payment_method`='$gateway',`shipping_name`='$shipping_name',`shipping_address1`='$shipping_address1',`shipping_address2`='$shipping_address2',`shipping_city`='$shipping_city',`shipping_province`='$shipping_province',`shipping_country`='$shipping_country',`shipping_zip`='$shipping_zip',`shipping_phone`='$shipping_phone',`billing_name`='$billing_name',`billing_address1`='$billing_address1',`billing_address2`='$billing_address2',`billing_city`='$billing_city',`billing_province`='$billing_province',`billing_country`='$billing_country',`billing_zip`='$billing_zip',`billing_phone`='$billing_phone',`booking_status`='$fulfillment_status' WHERE `sales_id`='$orderid' AND `user_id`='$userid'");
        }
        } 
        return redirect()->back()->with('success','Shopify Sales sync successfully!');
        }else{
            return redirect()->back()->with('error','Shopify Api Key not found!');
        }
        }
}
