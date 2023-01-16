<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Variant;
use App\Models\Value;
use App\Models\ProductVariant;
use App\Models\ProductVariantValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Validator;

class ProductController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();
       
    // dd($product->categories['name']);
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            if(request()->ajax()) {
                $product = Product::where('shop_id',$users->shop_id)->with('categories')->with('brands');
                return datatables()->of($product)
                ->addColumn('category_id', function($product){
                    return $product->categories['name'];
                 })
                 ->addColumn('sub_category_id', function($product){
                    return $product->sub_categories['name'] ?? '';
                 })
                 ->addColumn('brand_id', function($product){
                    return $product->brands['name'];
                 })
                ->addColumn('action', function($product){
                    $btn = '<a href="'.route("product.edit",$product->id).'"data-original-title="Edit" class="mr-1 btn-sm detailProduct"><i class="text-primary fa-solid fa-pen-to-square"></i></a>';
                    $btn .= '<form class="d-inline" method="POST" action="'.route("product.destroy", $product->id).'"><input type="hidden" name="_method" value="delete" /><input type="hidden" name="_token" value="'. csrf_token() .'" /><button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button></form>';
               
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }
        }else if($users->user_role == 3) {
            if(request()->ajax()) {
                $product = Product::with('categories')->with('brands');
                return datatables()->of($product)
                ->addColumn('category_id', function($product){
                    return $product->categories['name'];
                 })
                 ->addColumn('sub_category_id', function($product){
                    return $product->sub_categories['name'] ?? '';
                 })
                 ->addColumn('brand_id', function($product){
                    return $product->brands['name'];
                 })
                ->addColumn('action', function($product){
                   $btn = '<a href="'.route("product.edit",$product->id).'"data-original-title="Edit" class="text-primary mr-1 btn-sm detailProduct"><i class="fa-solid fa-pen-to-square"></i></a>';
                   $btn .= '<form class="d-inline" method="POST" action="'.route("product.destroy", $product->id).'"><input type="hidden" name="_method" value="delete" /><input type="hidden" name="_token" value="'. csrf_token() .'" /><button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button></form>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);  
            }
        }else{
            return redirect()->back();
        }
        
        return view('product.index');
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
            $categories = Category::where('parent_id',0)->get();
            $brands = Brand::all();
            $products = Product::all();
            $units = Unit::all();
            $variants = Variant::all();
            $values = Value::all();
            return view('product.create', compact('categories', 'brands', 'units', 'variants', 'values', 'products'));
            // return redirect()->back();
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
        // dd($request->all());
        
        $user_id = auth()->user();
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sku' => 'required',
            'sub_category_id' => 'nullable',
            'category_id' => 'required',
            'brand_id' => 'required',
            'image' => 'nullable|image:jpg,jpeg,png',
            'product_boosear' => 'nullable',
            'weight' => 'required',
            'unit' => 'required',
            'description' => 'required',
            'sell_price' => 'required',
            'purchase_price' => 'required',
            'alert_query' => 'required',
            'product_type' => 'required',
            'model_no' => 'nullable',
            'rack_no' => 'nullable',
            'barcode' => 'required',
            'barcode_type' => 'nullable',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = New Product;
        $image = $request->file('image');
        $product_boosear = $request->file('product_boosear');
        if($image != '')
        {
            $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imagename);
            $product->image=$imagename;
        }

        if($product_boosear != '')
        {
            $product_boosear_name = pathinfo($product_boosear->extension(), PATHINFO_FILENAME) . '-' . time() . '.' . $product_boosear->extension();
            $product_boosear->move(public_path('uploads/boosear'), $product_boosear_name);
            $product->product_boosear=$product_boosear_name;
        }

        $product->name=$request->name;
        $product->sub_category_id=$request->sub_category_id;   //new parent_id
        $product->shop_id=$users->shop_id;
        $product->sku=$request->sku;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->weight=$request->weight;
        $product->unit=$request->unit;
        $product->description=$request->description;
        $product->sell_price=$request->sell_price;
        $product->purchase_price=$request->purchase_price;
        $product->alert_query=$request->alert_query;
        $product->product_type=$request->product_type;
        $product->model_no=$request->model_no;
        $product->rack_no=$request->rack_no;
        $product->barcode=$request->barcode;
        $product->barcode_type=$request->barcode_type;
        $product->status=$request->status;
        $product->save();

        return redirect()->route('product.index')->with('success','Product Insert successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $users = Auth::user();

        if($users->user_role != 3){
            $categories = Category::where('parent_id',0)->get();
            $brands = Brand::all();
            return view('product.edit', compact('product', 'categories', 'brands'));
        }else{
            return redirect()->back();
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        // $product = Product::findOrFail($product);
        // dd($product->all());
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'sku' => 'required',
        //     'category' => 'required',
        //     'brand' => 'required',
        //     'image' => 'required|image:jpg,jpeg,png',
        //     'weight' => 'required',
        //     'unit' => 'required',
        //     'description' => 'required',
        //     'sell_price' => 'required',
        //     'purchase_price' => 'required',
        //     'alert_query' => 'required',
        //     'product_type' => 'required',
        //     'status' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        
        $image = $request->file('image');
        $product_boosear = $request->file('product_boosear');
        if($image != '')
        {
            unlink(public_path('uploads/products/'.$users->image));
            $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imagename);
            $users->image=$imagename;
        }

        if($product_boosear != '')
        {
            unlink(public_path('uploads/boosear/'.$product->product_boosear));
            $product_boosear_name = pathinfo($product_boosear->extension(), PATHINFO_FILENAME) . '-' . time() . '.' . $product_boosear->extension();
            $product_boosear->move(public_path('uploads/boosear'), $product_boosear_name);
            $product->product_boosear=$product_boosear_name;
        }


        $product->name=$request->name;
        $product->sku=$request->sku;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->weight=$request->weight;
        $product->unit=$request->unit;
        $product->description=$request->description;
        $product->sell_price=$request->sell_price;
        $product->purchase_price=$request->purchase_price;
        $product->alert_query=$request->alert_query;
        $product->product_type=$request->product_type;
        $product->model_no=$request->model_no;
        $product->rack_no=$request->rack_no;
        $product->barcode=$request->barcode;
        $product->barcode_type=$request->barcode_type;
        $product->status=$request->status;
        $product->save();

        return redirect()->route('product.index')->with('success','Product update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        Product::findOrFail($id)->delete();
     
        return redirect()->back()->with('success','Product deleted successfully!');
    }

    public function getsubcategory(Request $request)
    {
        $data = Category::where('parent_id',$request->category_id)->get();
        return response()->json($data);
    }

    public function getvarientvalue(Request $request)
    {
        $data = Value::where('variants_id',$request->id)->get();
        return response()->json($data);
    }
}
