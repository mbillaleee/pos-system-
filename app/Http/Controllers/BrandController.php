<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();
        if($users->user_role != 3){
            $brands = Brand::where('shop_id',$users->shop_id)->latest()->get();
            return view('brand.index',compact('brands'))
            ->with('i', 1);
            
        }else{
            $brands = Brand::latest()->get();
            return view('brand.index',compact('brands'))
            ->with('i', 1);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('ok');
        $users = Auth::user();
        if($users->user_role != 3){
            return view('brand.create');
            
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'short_desc' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $brand = New Brand;

        $brand->name=$request->name;
        $brand->short_desc=$request->short_desc;
        $brand->shop_id=$users->shop_id;
        $brand->save();

        return redirect()->route('brand.lists')->with('success','Brand created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'short_desc' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $brand->name=$request->name;
        $brand->short_desc=$request->short_desc;
        $brand->save();

        return redirect()->route('brand.lists')->with('success','Brand update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->back()->with('success','Brand deleted successfully!');
    }
}
