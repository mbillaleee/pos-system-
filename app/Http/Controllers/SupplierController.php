<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datatables;
use Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();
  
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            if(request()->ajax()) {
                $supp = Supplier::where('shop_id',$users->shop_id)->get();
                return datatables()->of($supp)
                ->addColumn('action', function($supp){
                   $btn = '<a href="'.route("suppliers.edit",$supp->id).'"data-original-title="Edit" class="detailProduct"><i class="text-primary fa-solid fa-pen-to-square"></i></a>';
                   $btn .= '<form class="d-inline" method="POST" action="'.route("suppliers.destroy", $supp->id).'"><input type="hidden" name="_method" value="delete" /><input type="hidden" name="_token" value="'. csrf_token() .'" /><button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button></form>';
               
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }
        }
        else if($users->user_role == 3) {
            if(request()->ajax()) {
                $supp = Supplier::all();
                return datatables()->of($supp)
                ->addColumn('action', function($supp){
                    $btn = '<a href="'.route("suppliers.edit",$supp->id).'"data-original-title="Edit" class="detailProduct"><i class="text-primary fa-solid fa-pen-to-square"></i></a>';
                    $btn .= '<form class="d-inline" method="POST" action="'.route("suppliers.destroy", $supp->id).'"><input type="hidden" name="_method" value="delete" /><input type="hidden" name="_token" value="'. csrf_token() .'" /><button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }
        }else{
            return redirect()->back();
        }
        
        return view('suppliers.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Auth::user();
        if($users->user_role != 1 ){
            return redirect()->back();
        }else{
            return view('suppliers.create');
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
        // $users = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|max:255',
            'email' => ['required', 'email', 'max:255', 'unique:suppliers,email'],
            'phone' => 'required|max:255|unique:suppliers,phone',
            'phone' => 'required|unique:suppliers',
            'tax_number' => 'nullable|max:255',
            'opening_balance' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'nullable|max:255',
            'country' => 'required|max:255',
            'zip_code' => 'required|max:255',
            'status' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $suppliers = New Supplier;
        
        $suppliers->name=$request->name;
        $suppliers->shop_id=$users->shop_id;
        $suppliers->company_name=$request->company_name;
        $suppliers->email=$request->email;
        $suppliers->phone=$request->phone;
        $suppliers->tax_number=$request->tax_number;
        $suppliers->opening_balance=$request->opening_balance;
        $suppliers->address=$request->address;
        $suppliers->city=$request->city;
        $suppliers->state=$request->state;
        $suppliers->country=$request->country;
        $suppliers->zip_code=$request->zip_code;
        $suppliers->status=1;
        $suppliers->save();

        return redirect()->route('suppliers.list')->with('success','suppliers created successfully!');

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $users = Auth::user();
        if($users->user_role != 1 ){
            return redirect()->back();
        }else{
            return view('suppliers.edit', compact('supplier'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier )
    {
        // $supplier = Supplier::findOrFail($supplier);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|max:255',
            'email' => 'required|string|email|max:255|unique:suppliers,email,'.$supplier->id,
            'phone' => 'required|string|unique:suppliers,phone,'.$supplier->id,
            'tax_number' => 'nullable|max:255',
            'opening_balance' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'nullable|max:255',
            'country' => 'required|max:255',
            'zip_code' => 'required|max:255',
            'status' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $supplier->name=$request->name;
        $supplier->company_name=$request->company_name;
        $supplier->email=$request->email;
        $supplier->phone=$request->phone;
        $supplier->tax_number=$request->tax_number;
        $supplier->opening_balance=$request->opening_balance;
        $supplier->address=$request->address;
        $supplier->city=$request->city;
        $supplier->state=$request->state;
        $supplier->country=$request->country;
        $supplier->zip_code=$request->zip_code;
        $supplier->status=$request->status;
        $supplier->save();



        return redirect()->route('suppliers.list')->with('success','supplier update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $users = Auth::user();
        if($users->user_role != 1 ){
            return redirect()->back();
        }else{
        Supplier::findOrFail($id)->delete();
     
        return redirect()->back()->with('success','Supplier deleted successfully!');
        }
    }
}