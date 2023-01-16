<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\MyPos;
use App\Models\MyPosApi;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Imports\MyposImport;
use Maatwebsite\Excel\Facades\Excel;

class MyPosController extends Controller
{
    public function index(){
        $users = Auth::user();
        if($users->user_role == 3){
            if(request()->ajax()) {
                return datatables()->of(MyPos::select('*'))
                ->addColumn('action', 'mypos.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }
        }else{
        if(request()->ajax()) {
            return datatables()->of(MyPos::select('*')->where('shop_id',$users->shop_id))
            ->addColumn('action', 'mypos.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    }
        $mypos_api = MyPosApi::where('shop_id',$users->shop_id)->latest()->first();
        return view('mypos.product', compact('mypos_api'));
    }

    public function edit(Request $request)
	{   
	    $where = array('id' => $request->id);
	    $takealots  = MyPos::where($where)->first();
	 
	    return Response()->json($takealots);
	}

    public function update(Request $request)
    {  
        $takealotId = $request->id;


        $takealots = MyPos::where('id', $takealotId)->update([
                    'tsin' => $request->tsin, 
                    'rack_no' => $request->rack_no,
                    'code' => $request->code,
                    'price' => $request->price
                ]); 
                         
        // Session::flash('success', 'Product updated successfully!');
        return Response()->json($takealots);
 
    }

    public function destroy(Request $request)
    {
        $takealots = MyPos::where('id',$request->id)->delete();

        return Response()->json($takealots);
    }


    public function api_update(Request $request)
    {  
        $myposIds = $request->api_id;
        $users = Auth::user();
       if($users->user_role == 3){
            return redirect()->back()->with('error','You can not update!');
        }else{
            $shop_id = $users->shop_id;
        }

        if($myposIds != null){
            $mypos = MyPosApi::where('id', $myposIds)->update([
                'api_url' => $request->api_url
            ]); 
            }else{
                $mypos = MyPosApi::create([
                    'api_url' => $request->api_url,
                    'shop_id' => $users->shop_id
                ]); 
            }
                         
        return redirect()->back()->with('success','Api Key Updated Successfully!');
 
    }
    public function import()
    {
        Excel::import(new MyposImport,request()->file('mypos_import'));
               
        return back()->with('success','Product Imported Successfully!');
    }

    public function product_sync()
    {
        $users = Auth::user();
       if($users->user_role == 3){
            return redirect()->back()->with('error','You can not sync!');
        }else{
            $shop_id = $users->shop_id;
        }
     $api_take = MyPosApi::where('shop_id',$shop_id)->latest()->first();
     if($api_take){
     $url = $api_take->api_url;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
    $result = curl_exec($ch);
    curl_close($ch); 
    $result1 = json_decode($result, TRUE);
    // dd($result1);
    foreach($result1['products'] as $product){
                $exist_data = MyPos::where('product_id',$product['id'])->where('shop_id',$shop_id)->first();
                if($exist_data != null){
                    $myproducts = MyPos::findOrFail($exist_data->id);
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
        
        // $img = "http://wootech.biz/assets/uploads/".$product['image'];
                                    
        

    }

   
     return redirect()->back()->with('success','Product sync successfully!');
}else{
    return redirect()->back()->with('error','Product Api Key not found!');
}
    }
}
