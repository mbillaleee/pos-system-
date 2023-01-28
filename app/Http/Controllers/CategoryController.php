<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();
        if($users->user_role == 3){
            $categories = Category::where('parent_id',0)->latest()->get();
            return view('category.index',compact('categories'))->with('i', 1);
        }else{
            $categories = Category::where('parent_id',0)->where('shop_id',$users->shop_id)->latest()->get();
            // dd($categories);
            return view('category.index',compact('categories'))->with('i', 1);
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
            $categories = Category::where('parent_id',0)->orderBy('name','asc')->get();
            return view('category.create',compact('categories'));
            
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

        $users = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'parent_id' => 'nullable|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = New Category;

        $category->name=$request->name;
        $category->parent_id=$request->parent_id;
        $category->shop_id=$users->shop_id;
        $category->save();

        return redirect()->route('category.index')->with('success','Category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $category  = Category::where('id', $request->id)->first();
	 
	    return Response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'parent_id' => 'nullable|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $catId = $request->id;

        $category = Category::where('id', $catId)->first(); 
        $category->name=$request->name;
        $category->parent_id=$request->parent_id;
        $category->update();

        return redirect()->back()->with('success','Category update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success','Category deleted successfully!');
    }
}
