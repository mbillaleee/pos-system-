<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Models\Value;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();
        if($users->user_role == 1){
            $variants = Variant::latest()->get();
            return view('variant.index',compact('variants'))
            ->with('i', 1);
        }else{
            return redirect()->back();
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
        if($users->user_role == 1){
            return view('variant.create');
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
        // dd( $request->all());
        $users = Auth::user();
        //  $users = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'vari_name' => 'required|max:255|unique:variants',
            // 'value_name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $variant = New Variant;

        $variant->vari_name=$request->vari_name;
        $variant->shop_id=$users->shop_id;
        // $variant->save();

        if($variant->save()){
            $id=$variant->id;
            // dd($variant->id);
            foreach ($request->value_name  as $key => $vl){
                $data = array(
                    'variants_id'=>$id,
                    'value_name'=>$vl,
                );
                Value::insert($data);
            }
        }

        return redirect()->route('variant.index')->with('success','Varient created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function show(Variant $variant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = Auth::user();
        if($users->user_role == 1){
            $variant = Variant::where('id',$id)->first();
            $variant_value = Value::where('variants_id',$id)->get(); 
            return view('variant/edit', compact('variant','variant_value'));
            
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variant $variant)
    {
         // dd( $request->all());
         $validator = Validator::make($request->all(), [
            // 'vari_name' => 'required|max:255|unique:variants',
            // 'value_name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        

        $variant->vari_name=$request->vari_name;
        // $variant->save();
        if($variant->save()){
            $id=$variant->id;
            // dd($variant->id);
            Value::where('variants_id',$id)->delete();
            foreach ($request->value_name  as $key => $vl){
                $data = array(
                    'variants_id'=>$id,
                    'value_name'=>$vl,
                );
                Value::updateOrCreate($data);
            }
        }

        return redirect()->route('variant.index')->with('success','Varient Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        Value::where('variants_id',$id)->delete();
        $variant = Variant::findOrFail($id);
        $variant->delete();
        return redirect()->back()->with('success','Variant deleted successfully!');
    }


    public function variantAdd(Request $request) {
        $data = Product::where('id',$request->id)->first();
        return response()->json($data);
    }
}
