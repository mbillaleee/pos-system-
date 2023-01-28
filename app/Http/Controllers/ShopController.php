<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource. 
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $users = Auth::user();
        if($users->user_role != 1 ){
            return redirect()->back();
        }else{
            
            return view('users/shop-setting', compact('shop'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        // dd($shop);

            if(isset($shop['upload_logo'])){
                $upload_logo = $request->file('upload_logo') ?? '';
                if($upload_logo != '')
                {
                    if($shop->upload_logo != null){
                    unlink(public_path('uploads/products/'.$shop->upload_logo));
                    }
                    $imagename = pathinfo($upload_logo->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $upload_logo->getClientOriginalExtension();
                    $upload_logo->move(public_path('uploads/logos'), $imagename);
                    $shop->upload_logo=$imagename;
                }
            }
            $shop->business_name=$request->business_name;
            $shop->start_date=$request->start_date;
            $shop->currency=$request->currency;
            $shop->website=$request->website;
            $shop->business_contact=$request->business_contact;
            $shop->alternate_contact=$request->alternate_contact;
            $shop->country=$request->country;
            $shop->state=$request->state;
            $shop->city=$request->city;
            $shop->zip_code=$request->zip_code;
            $shop->land_mark=$request->land_mark;
            $shop->time_zone=$request->time_zone;
            $shop->save();

            return redirect()->back()->with('success','Shop updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
