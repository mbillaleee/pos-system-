<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\PosMinPrice;
use App\Models\MyPos;
use App\Models\MyPosApi;
use App\Models\Shopify;
use App\Models\ShopifyApi;
use App\Models\ShopifySale;
use App\Models\ShopifySaleRefund;
use App\Models\ShopifySaleDetail;
use App\Models\Takealot;
use App\Models\TakealotApi;
use App\Models\TakealotSale;

class HourlyUpdateAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively update all api data to everyone hourly.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    // Takealot Start

    $api_take = TakealotApi::latest()->get();
    if($api_take){
    foreach($api_take as $apt){
    $tapi = $apt->api_key;
                                
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
                        
            foreach($result['offers'] as $product){   
                $exist_takealot = Takealot::where('tsin',$product['tsin_id'])->where('shop_id',$apt->shop_id)->first();
                if($exist_takealot == null){
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
                    $takealots->shop_id = $users->shop_id;
                    $takealots->save();
                }

            }
        }
    }

    // Start Takealot Sales
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
                                                            
                        $exist_takealot_sale = TakealotSale::where('order_item_id',$order_item_id)->where('shop_id',$apt->shop_id)->first();
                        if(isset($exist_takealot_sale)){
                            $takealots = TakealotSale::findOrFail($exist_takealot_sale->id);
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
                            $takealots->shop_id = $users->shop_id;
                            $takealots->save();
                            
                        }
                    }
            }
        }

}
}

 //Shopify Start
$api_shopify = ShopifyApi::latest()->get();

if($api_shopify){
    foreach($api_shopify as $ashop){
$sapi = $ashop->api;
$spassword = $ashop->password;
$surl = $ashop->url;

$items_per_page = 250;
$merged = array();
$next_page = '';
$last_page = false;


while(!$last_page) 
{
    $spurl = 'https://'.$sapi.':'.$spassword.'@'.$surl.'/admin/products.json?limit=' . $items_per_page . $next_page; // . '&fields=';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $spurl);
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

foreach($merged['products'] as $product){
 
            $exist_data = Shopify::where('product_id',$product['id'])->where('shop_id',$ashop->shop_id)->first();
            if($exist_data != null){
                $shopify_products = Shopify::findOrFail($exist_data->id);
                $shopify_products->regular_price = $product['variants'][0]['compare_at_price'];
                $shopify_products->price = $product['variants'][0]['price'];
                $shopify_products->qty = $product['variants'][0]['inventory_quantity'];
                $shopify_products->sku = $product['variants'][0]['sku'];
                $shopify_products->description = $product['body_html'];
                $shopify_products->update();
            }else{
                $shopify_products = new Shopify;
                $shopify_products->product_id = $product['id'];
                $shopify_products->variants_id = $product['variants'][0]['id'];
                $shopify_products->title = $product['title'];
                $shopify_products->regular_price = $product['variants'][0]['compare_at_price'];
                $shopify_products->price = $product['variants'][0]['price'];
                $shopify_products->qty = $product['variants'][0]['inventory_quantity'];
                $shopify_products->sku = $product['variants'][0]['sku'];
                $shopify_products->barcode = $product['variants'][0]['barcode'];
                if($product['image']){
                $shopify_products->image = $product['image']['src']; 
                }
                $shopify_products->link = "https://".$shopurl."/products/".$product['handle'];
                $shopify_products->description = $product['body_html'];
                $shopify_products->shop_id = $shop_id;
                $shopify_products->save();
            }

    
}

      // Start Shopify Sale  
while(!$last_page) 
{   
    if($next_page == '')
    {
        $ssurl = "https://".$sapi.":".$spassword."@".$surl."/admin/orders.json?status=any&limit=" . $items_per_page; // . '&fields=';
    }
    else
    {
        $ssurl = "https://".$sapi.":".$spassword."@".$surl."/admin/orders.json?limit=" . $items_per_page . $next_page; // . '&fields=';
    }
    $headers = array();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $ssurl);
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
            $ssrefundquery = ShopifySaleRefund::where('sales_id',$orderid)->where('refund_id',$shopifyrefundid)->where('shop_id',$ashop->shop_id)->first();
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
                $ssrefundinsert->shop_id = $users->shop_id;
                $ssrefundinsert->save();
                
            }
            else
            {
                $sslineitemsupdate = ShopifySaleRefund::findOrFail($ssrefundquery->id);
                $sslineitemsupdate->product_name = $refunditemtitle;
                $sslineitemsupdate->product_price = $refunditemprice;
                $sslineitemsupdate->quantity = $refunditemqty;
                $sslineitemsupdate->product_total = $refunditemtotal;
                $sslineitemsupdate->update();
                
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
        $sslineitemsquery = ShopifySaleDetail::where('sales_id',$orderid)->where('lineitems_id',$shopifylineitemsid)->where('shop_id',$ashop->shop_id)->first();
        // $sslineitemsquery = execquery("SELECT * FROM `salesshopify_details` WHERE `sales_id`='$orderid' AND `lineitems_id`='$shopifylineitemsid' AND `user_id`='$userid'");
        if($sslineitemsquery == null){
            $sslineitemsinsert = new ShopifySaleDetail;
            $sslineitemsinsert->sales_id = $orderid;
            $sslineitemsinsert->lineitems_id = $shopifylineitemsid;
            $sslineitemsinsert->product_name = $lineitemtitle;
            $sslineitemsinsert->product_price = $lineitemprice;
            $sslineitemsinsert->quantity = $lineitemqty;
            $sslineitemsinsert->product_total = $lineitemtotal;
            $sslineitemsinsert->shop_id = $users->shop_id;
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
    $query = ShopifySale::where('sales_id',$orderid)->where('shop_id',$ashop->shop_id)->first();
    
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
        $shopifysalesquery->shop_id = $users->shop_id;
        $shopifysalesquery->save();
        
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
        
    }
    } 
    
}
}


    // MyPos Start

    $api_mypos = MyPosApi::latest()->get();
    if($api_mypos){
        foreach($api_mypos as $ampos){
    $murl = $ampos->api_url;

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL,$murl);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
   $result = curl_exec($ch);
   curl_close($ch); 
   $result1 = json_decode($result, TRUE);
   // dd($result1);
   foreach($result1['products'] as $product){
               $exist_mypos = MyPos::where('product_id',$product['id'])->where('shop_id',$ampos->shop_id)->first();
               if($exist_mypos != null){
                   $myproducts = MyPos::findOrFail($exist_mypos->id);
                   $myproducts->cost = $product['cost'];
                   $myproducts->price = $product['price'];
                   $myproducts->quantity = $product['quantity'];
                   $myproducts->type = $product['type'];
                   $myproducts->price_group_name = 'Wholsale';
                   $myproducts->update();
               }else{
                   $myproducts = new MyPos;
                   $myproducts->product_id = $product['id'];
                   $myproducts->code = $product['code'];
                   $myproducts->name = $product['name'];
                   $myproducts->unit = $product['unit'];
                   $myproducts->cost = $product['cost'];
                   $myproducts->price = $product['price'];
                   $myproducts->quantity = $product['quantity'];
                   $myproducts->type = $product['type'];
                   $myproducts->price_group_name = 'Wholsale';
                   $myproducts->shop_id = $users->shop_id;
                   $myproducts->save();
               }     

   }

}
    }




    


    }
}
