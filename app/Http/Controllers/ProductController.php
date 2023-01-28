<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Variant;
use App\Models\Value;
use App\Models\ProductVariant;
use App\Models\ProductComboValues;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Validator;
use Illuminate\Support\Str;

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
                 ->addColumn('quantity', function($product){
                    return Product::available_qty($product->id) ?? 0;
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
            $products = Product::where('shop_id',$users->shop_id)->get();
            $variants = Variant::all();
            $values = Value::all();
            $suppliers = Supplier::where('shop_id',$users->shop_id)->get();
            
            return view('product.create', compact('suppliers','categories', 'brands', 'variants', 'values', 'products'));
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
        //  dd($request->all());
        

        
        $users = Auth::user();

        // $users = auth()->user();
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sku' => 'nullable',
            'sub_category_id' => 'nullable',
            'category_id' => 'required',
            'supplier_id' => 'nullable',
            'brand_id' => 'required',
            'image' => 'nullable|image:jpg,jpeg,png',
            'product_boosear' => 'nullable',
            'weight' => 'nullable',
            'unit' => 'nullable',
            'description' => 'nullable',
            'sell_price' => 'nullable',
            'purchase_price' => 'nullable',
            'alert_query' => 'nullable',
            'product_type' => 'required',
            'model_no' => 'nullable',
            'rack_no' => 'nullable',
            'barcode' => 'required',
            'barcode_type' => 'required',
            // 'varient_value_id' => 'nullable',
            // 'vari_purch_price' => 'nullable',
            // 'vari_sell_price' => 'nullable',
            // 'vari_image' => 'nullable',
            // 'status' => 'nullable',
            // 'status' => 'nullable',
            // 'status' => 'nullable',
            // 'status' => 'nullable',
            // 'product_id' => 'required|exists:products,id'
            
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
                $product_boosear_name = pathinfo($product_boosear->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $product_boosear->getClientOriginalExtension();
                $product_boosear->move(public_path('uploads/boosear'), $product_boosear_name);
                $product->product_boosear=$product_boosear_name;
            }

            // dd($request->variable_image);
            // console.log("ok");

            // dd($request->all());
            $product->name=$request->name;
            $product->sub_category_id=$request->sub_category_id;   //new parent_id
            $product->shop_id=$users->shop_id;
            $product->sku=$request->sku;
            $product->category_id=$request->category_id;
            $product->brand_id=$request->brand_id;
            $product->weight=$request->weight;
            $product->unit=$request->unit;
            $product->supplier_id=$request->supplier_id;
            $product->description=$request->description;
            if($request->product_type==1 || $request->product_type==2){
                $product->sell_price=$request->sell_price;
                $product->purchase_price=$request->purchase_price;
                }else{
                $product->sell_price=$request->combo_sell_price1;
                $product->purchase_price=$request->combo_purchase_price1;
                }
            $product->alert_query=$request->alert_query;
            $product->product_type=$request->product_type;
            $product->model_no=$request->model_no;
            $product->rack_no=$request->rack_no;
            $product->barcode=$request->barcode;
            $product->barcode_type=$request->barcode_type;
            $product->status=1;
            if($request->product_type==1){
            $product->save();
            }
           

            if($request->product_type==2){
                if($product->save()){
                    $id=$product->id;
                    foreach ($request->variants_value_id as $key => $vl){ 
                        $variable_image = $request->file('variable_image')[$key] ?? '';
                        if($variable_image != '')
                        {
                            $imagename = pathinfo($variable_image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $variable_image->getClientOriginalExtension();
                            $variable_image->move(public_path('uploads/variantproducts'), $imagename);
                            $variable_image=$imagename;
                        }else{
                            $variable_image=null;
                        }
                    
                        $data = array(
                            'product_id'=>$id,
                            'product_variants_id'=>$request->product_variants_id [$key],
                            'variants_value_id'=>$vl,
                            'variant_purchase_price'=>$request->variant_purchase_price [$key],
                            'variant_sell_price'=>$request->variant_sell_price [$key],
                            'variable_image'=>$variable_image 
            
                        );
                        ProductVariant::insert($data);
                    }
                }
                
            }

            if($request->product_type==3){
                if($product->save()){
                    $id=$product->id;
                    foreach ($request->product_id as $key => $vl){ 
                    
                        $data = array(
                            'product_id'=>$id,
                            'combo_product_id'=>$vl,
                            'combo_quantity'=>$request->combo_quantity [$key],
                            // 'combo_sell_price'=>$request->combo_sell_price [$key],
                            'combo_purchase_price'=>$request->combo_purchase_price [$key],
                            'total_amount'=>$request->total_amount [$key],
            
                        );
                        ProductComboValues::insert($data);
                    }
                }
                
            }
  

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
            $products = Product::where('shop_id',$users->shop_id)->get();
            $variants = Variant::all();
            $suppliers = Supplier::where('shop_id',$users->shop_id)->get();
            $product_variants = ProductVariant::where('product_id',$product->id)->get();
            $combo_products = ProductComboValues::where('product_id',$product->id)->get();
            
            // dd($product_variants);
            // dd($combo_products);
            return view('product.edit', compact('suppliers','product', 'categories', 'brands', 'variants', 'products', 'product_variants', 'combo_products'));
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

        // dd($request->all());
        $product = Product::findOrFail($product);
        dd($product->all());
        $validator = Validator::make($request->all(), [
            // 'name' => 'required',
            // 'sku' => 'required',
            // 'category' => 'required',
            // 'brand' => 'required',
            'image' => 'required|image:jpg,jpeg,png',
            // 'weight' => 'required',
            // 'unit' => 'required',
            // 'description' => 'required',
            // 'sell_price' => 'required',
            // 'purchase_price' => 'required',
            // 'alert_query' => 'required',
            // 'product_type' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $image = $request->file('image');
        $product_boosear = $request->file('product_boosear');
        if($image != '')
        {
            if($product->image != null){
            unlink(public_path('uploads/products/'.$product->image));
            }
            $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imagename);
            $product->image=$imagename;
        }

        if($product_boosear != '')
        {
            if($product->product_boosear != null){
            unlink(public_path('uploads/boosear/'.$product->product_boosear));
            }
            $product_boosear_name = pathinfo($product_boosear->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $product_boosear->getClientOriginalExtension();
            $product_boosear->move(public_path('uploads/boosear'), $product_boosear_name);
            $product->product_boosear=$product_boosear_name;
        }


        $product->name=$request->name;
        $product->sku=$request->sku;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->weight=$request->weight;
        $product->unit=$request->unit;
        $product->supplier_id=$request->supplier_id;
        $product->description=$request->description;
        if($request->product_type==1 || $request->product_type==2){
            $product->sell_price=$request->sells_price;
            $product->purchase_price=$request->purchases_price;
            }else{
            $product->sell_price=$request->combo_sell_price1;
            $product->purchase_price=$request->combo_purchase_price1;
            }
        $product->alert_query=$request->alert_query;
        $product->product_type=$request->product_type;
        $product->model_no=$request->model_no;
        $product->rack_no=$request->rack_no;
        $product->barcode=$request->barcode;
        $product->barcode_type=$request->barcode_type;
        $product->status=1;
        if($request->product_type==1){
        $product->update();
        }


        
        if($request->product_type==2){
            if($product->update()){
                $id=$product->id;

                // $product_variant_exit = ProductVariant::where('product_id',$product->id)->get();
                // if($product_variant_exit != null){
                //     foreach($product_variant_exit as $pve){
                //         if($pve->variable_image != null){
                //             unlink(public_path('uploads/variantproducts/'.$pve->variable_image)); 
                //         }
                //     }
                // }
                // $product_variant_exit->delete();
                $existing_variant = [];
                foreach ($request->variants_value_id as $key => $vl){ 
                    $vrid = $request->variant_id [$key] ?? '';
                    $variable_image = $request->file('variable_image')[$key] ?? '';
                    if($vrid != ''){
                        $existing_variant[] = $vrid;
                        $pr_image = ProductVariant::where('id',$vrid)->first();
                        if($variable_image != ''){
                            if($pr_image->variable_image != ''){
                                unlink(public_path('uploads/variantproducts/'.$pr_image->variable_image));
                            }
                        $imagename = pathinfo($variable_image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $variable_image->getClientOriginalExtension();
                        $variable_image->move(public_path('uploads/variantproducts'), $imagename);
                        $pr_image->variable_image = $imagename;
                        }
                        $pr_image->product_id = $id;
                        $pr_image->product_variants_id = $request->product_variants_id [$key];
                        $pr_image->variants_value_id = $vl;
                        $pr_image->variant_purchase_price = $request->variant_purchase_price [$key];
                        $pr_image->variant_sell_price = $request->variant_sell_price [$key];
                        $pr_image->update(); 
                    }else{
                        $pr_image = new ProductVariant;
                        if($variable_image != ''){
                        $imagename = pathinfo($variable_image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $variable_image->getClientOriginalExtension();
                        $variable_image->move(public_path('uploads/variantproducts'), $imagename);
                        $pr_image->variable_image = $imagename;
                        }
                        $pr_image->product_id = $id;
                        $pr_image->product_variants_id = $request->product_variants_id [$key];
                        $pr_image->variants_value_id = $vl;
                        $pr_image->variant_purchase_price = $request->variant_purchase_price [$key];
                        $pr_image->variant_sell_price = $request->variant_sell_price [$key];
                        $pr_image->save();
                    }

                                     
                }
                // dd($existing_variant);  
                $pr = ProductVariant::where('product_id',$id)->whereNotIn('id',$existing_variant)->delete();
                // dd($pr);
            }
            
        }

        if($request->product_type==3){
            if($product->update()){
                $id=$product->id;
                ProductComboValues::where('product_id',$id)->delete();
                foreach ($request->product_id as $key => $vl){ 
                
                    $data = array(
                        'product_id'=>$id,
                        'combo_product_id'=>$vl,
                        'combo_quantity'=>$request->combo_quantity [$key],
                        // 'combo_sell_price'=>$request->combo_sell_price [$key],
                        'combo_purchase_price'=>$request->combo_purchase_price [$key],
                        'total_amount'=>$request->total_amount [$key],
        
                    );
                    ProductComboValues::updateOrInsert($data);
                }
            }
            
        }

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





    public function productComboPrice(Request $request) {
        $data = Product::where('id',$request->id)->first();
        return response()->json($data); 
    }
}
