<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Shopify;
use App\Models\ShopifyApi;
use App\Models\MyPos;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Session;
use Illuminate\Support\Arr;

class ShopifyController extends Controller
{
    public function index(){
        $users = Auth::user();
        if($users->user_role == 3){
            if(request()->ajax()) {
                return datatables()->of(Shopify::select('*'))
                ->addColumn('action', 'shopify.action')
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
            return datatables()->of(Shopify::select('*')->where('user_id',$user_id))
            ->addColumn('action', 'shopify.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    }
        $shopify_api = ShopifyApi::where('user_id',$user_id)->latest()->first();
        return view('shopify.product',compact('shopify_api'));
    }

    public function edit(Request $request)
	{   
	    $where = array('id' => $request->id);
	    $shopifys  = Shopify::where($where)->first();
	 
	    return Response()->json($shopifys);
	}

    public function update(Request $request)
    {  
 
        $shopifyId = $request->id;

        $shopifys = Shopify::where('id', $shopifyId)->update([ 
                    'regular_price' => $request->regular_price, 
                    'price' => $request->price,
                    'qty' => $request->qty,
                    'barcode' => $request->barcode
                ]); 
                         
        // Session::flash('success', 'Product updated successfully!');
        return Response()->json($shopifys);
 
    }

    public function api_update(Request $request)
    {  
        
        $shopifyIds = $request->api_id;
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 3){
            return redirect()->back()->with('error','You can not update!');
        }else{
            $user_id = $users->parent_id;
        }
        
        if($shopifyIds != null){
            $shopify = ShopifyApi::where('id', $shopifyIds)->update([
                'api' => $request->api,
                'password' => $request->password,
                'url' => $request->url,
            ]); 
            }else{
                $shopify = ShopifyApi::create([
                    'api' => $request->api,
                    'password' => $request->password,
                    'url' => $request->url,
                    'user_id' => $user_id,
                ]); 
            }
        // Session::flash('success','your comment has been deleted');              
        return redirect()->back()->with('success','Api Updated Successfully!');
 
    }

    public function product_sync(){
    
    // header('Content-Type: application/json');
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
        $url = 'https://'.$api.':'.$password.'@'.$shopurl.'/admin/products.json?limit=' . $items_per_page . $next_page; // . '&fields=';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);
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
    //  dd($merged['products']);
    foreach($merged['products'] as $product){
        // $allimages = $product['images'];
// dd($product);
                $exist_data = Shopify::where('product_id',$product['id'])->where('user_id',$user_id)->first();
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
                    $shopify_products->user_id = $user_id;
                    $shopify_products->save();
                }

        
    }
    return redirect()->back()->with('success','Product sync successfully!');
    }else{
        return redirect()->back()->with('error','Product Api Key not found!');
    }
    }

    public function update_qty() {

        return view('shopify.update_qty'); 
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

        $mypos_data_shopify = MyPos::where('user_id',$user_id)->where('code','!=',Null)->get();

        foreach($mypos_data_shopify as $mshop) {
            $shopify = Shopify::where('barcode',$mshop->code)->first();
            if($shopify != null){
            $shopify->qty = $mshop->quantity;
            $shopify->update();
            }
        }

        return redirect()->back()->with('success','Quantity updated from pos data successfully!');
    }
}
