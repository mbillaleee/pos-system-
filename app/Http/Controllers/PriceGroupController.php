<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriceGroup;
use App\Models\Product;
use App\Models\GroupProductPrice;
use Illuminate\Support\Facades\Auth;
use Validator;

class PriceGroupController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        if($users->user_role == 3){
            $price_group = PriceGroup::latest()->get();
            return view('price_group.index',compact('price_group'))->with('i', 1);
        }else{
            $price_group = PriceGroup::where('shop_id',$users->shop_id)->latest()->get();
            return view('price_group.index',compact('price_group'))->with('i', 1);
        }
    }

    public function create()
    {
        $users = Auth::user();
        if($users->user_role != 3){
            return view('price_group.create');
            
        }else{
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $users = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = New PriceGroup;

        $category->name=$request->name;
        $category->shop_id=$users->shop_id;
        $category->save();

        return redirect()->route('price.group')->with('success','Price Group created successfully!');
    }

    public function edit($id)
    {
        $price_group = PriceGroup::findOrFail($id);
        return view('price_group.edit', compact('price_group'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $price_group = PriceGroup::findOrFail($id);
        $price_group->name=$request->name;
        $price_group->update();

        return redirect()->route('price.group')->with('success','Price Group update successfully!');
    }

    public function destroy($id)
    {
        $price_group = PriceGroup::findOrFail($id);
        $price_group->delete();
        return redirect()->back()->with('success','Price Group deleted successfully!');
    }

    public function group_product_prices($id)
    {
        $users = Auth::user();
        $price_group = PriceGroup::findOrFail($id);
        $products = Product::where('shop_id',$users->shop_id)->get();
        return view('price_group.group_product_prices', compact('price_group','products'));
    }

    public function group_product_prices_update(Request $request)
    {
        $users = Auth::user();

        $products = GroupProductPrice::where('product_id',$request->product_id)->where('price_group_id',$request->price_group_id)->where('shop_id',$users->shop_id)->first();
        if($request->price != null){
        if(empty($products)){
            $data = New GroupProductPrice;
            $data->product_id = $request->product_id;
            $data->price_group_id = $request->price_group_id;
            $data->price = $request->price;
            $data->shop_id = $users->shop_id;
            $data->save();
        }
        }else{
            $data = 'price_empty';
        }
        
        return response()->json($data);
    }

    public function group_product_prices_delete(Request $request)
    {

        $products = GroupProductPrice::where('id',$request->group_product_prices_id)->first();
        if(!empty($products)){
            $products->delete(); 
            $data = 'success';
        }else{
            $data = 'data_empty';
        }
        
        return response()->json($data);
    }
}
