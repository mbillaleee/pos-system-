<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PosMinPrice;
use Illuminate\Support\Facades\Auth;
use Datatables;

class PosMinPriceController extends Controller
{
    public function index(){
        $users = Auth::user();
        if($users->user_role == 3){
            if(request()->ajax()) {
                return datatables()->of(PosMinPrice::select('*')->latest())
                ->addColumn('action', 'posminprice.action')
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
            return datatables()->of(PosMinPrice::select('*')->where('user_id',$user_id)->latest())
            ->addColumn('action', 'posminprice.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        }
        return view('posminprice.index');
    }

    public function edit(Request $request)
	{   
	    $where = array('id' => $request->id);
	    $posminprices  = PosMinPrice::where($where)->first();
	 
	    return Response()->json($posminprices);
	}

    public function update(Request $request)
    {  
 
        $posminprice = $request->id;

        $posminprices = PosMinPrice::where('id', $posminprice)->update([
                    'tsin' => $request->tsin, 
                ]); 
                         
        // Session::flash('success', 'Product updated successfully!');
        return Response()->json($posminprices);
 
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
    $login = "admin";
    $password = "pass";
    $url = "www.woo-pos.com/wooposproduct.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
    $result = curl_exec($ch);
    curl_close($ch);
    $result1 = json_decode($result, TRUE);
                               
    foreach ($result1 as $product) 
    {
        if (isset($product['id'])) {
            $id = $product['id'];
        }
        if (isset($product['name'])) {
            $name = $product['name'];
            // $name1 = mysqli_real_escape_string($con, $name);
        }
        if (isset($product['cost'])) {
            $cost = $product['cost'];
            $cost1 = str_replace('.0000', '', $cost);
        }
        if (isset($product['rack_no'])) {
            $rack_no = $product['rack_no'];
        }else{
            $rack_no = Null;
        }
        
        if((0 <= $cost1) && ($cost1 <= 10))
        {
            $courier = 40;
            $per = 17;
            $courierandcost = $cost1 + $courier;
                
            $cal = ($per / 100) * $courierandcost; 
            $minsell = $courierandcost + $cal;
        }
        elseif((11 <= $cost1) && ($cost1 <= 40))
        {
            $courier = 40;
            $per = 18;
            $courierandcost = $cost1 + $courier;
            
            $cal = ($per / 100) * $courierandcost; 
            $minsell = $courierandcost + $cal;
        }
        elseif((41 <= $cost1) && ($cost1 <= 80))
        {
            $courier = 40;
            $per = 19;
            $courierandcost = $cost1 + $courier;
            
            $cal = ($per / 100) * $courierandcost; 
            $minsell = $courierandcost + $cal;
        }
        elseif(81 <= $cost1)
        {
            $courier = 40;
            $per = 20;
            $courierandcost = $cost1 + $courier;
                                                        
            $cal = ($per / 100) * $courierandcost; 
            $minsell = $courierandcost + $cal;
        }

                $exist_data = PosMinPrice::where('pos_id',$id)->where('user_id',$user_id)->first();
                if($exist_data != null){
                    $posminprice = PosMinPrice::findOrFail($exist_data->id);
                    $posminprice->product_name = $name;
                    $posminprice->product_price = $cost1;
                    $posminprice->product_min_price = round($minsell);
                    $posminprice->rack_no = $rack_no;
                    if($rack_no != Null) {
                    $posminprice->sku = 'C'.round($cost1).'M'.round($minsell).'-'.$rack_no;
                    }else{
                    $posminprice->sku = 'C'.round($cost1).'M'.round($minsell);
                    }
                    $posminprice->update();
                }else{
                    $posminprice = new PosMinPrice;
                    $posminprice->pos_id = $id;
                    $posminprice->product_name = $name;
                    $posminprice->product_price = $cost1;
                    $posminprice->product_min_price = round($minsell);
                    $posminprice->product_staus = 'active';
                    $posminprice->tsin = Null;
                    $posminprice->rack_no = $rack_no;
                    if($rack_no != NUll) {
                    $posminprice->sku = 'C'.round($cost1).'M'.round($minsell).'-'.$rack_no;
                    }else{
                    $posminprice->sku = 'C'.round($cost1).'M'.round($minsell);
                    }
                    $posminprice->user_id = $user_id;
                    $posminprice->save();
                }                            
        
    }
    return redirect()->back()->with('success','Pos Minimum Price sync successfully!');
    
    }
}
