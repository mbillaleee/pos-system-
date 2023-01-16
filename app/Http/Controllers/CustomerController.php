<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Validator; 

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = Auth::user();
        if($users->user_role == 1){
            $user_id = $users->id;
        }elseif($users->user_role == 2){
            $user_id = $users->parent_id;
        }elseif($users->user_role == 4){
            $user_id = $users->parent_id;
        }
    
        if($users->user_role == 1 || $users->user_role == 2 || $users->user_role == 4){
            if(request()->ajax()) {
                $custo = Customer::where('user_id',$user_id)->get();
                return datatables()->of($custo)
                ->addColumn('action', function($custo){
                   $btn = '<a href="'.route("customers.edit",$custo->id).'"data-original-title="Edit" class="text-primary mr-1 detailProduct"><i class="fa-solid fa-pen-to-square"></i></a>';
                $btn .= '<form class="d-inline" method="POST" action="'.route("customers.destroy", $custo->id).'"><input type="hidden" name="_method" value="delete" /><input type="hidden" name="_token" value="'. csrf_token() .'" /><button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button></form>';
               
                   
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }
        }else if($users->user_role == 3) {
            if(request()->ajax()) {
                $custo = Customer::all();
                return datatables()->of($custo)
                ->addColumn('action', function($custo){
                   $btn = '<a href="'.route("customers.edit",$custo->id).'"data-original-title="Edit" class="mr-1 btn-sm detailProduct"><i class="text-primary fa-solid fa-pen-to-square"></i></a>';
                $btn .= '<form class="d-inline" method="POST" action="'.route("customers.destroy", $custo->id).'"><input type="hidden" name="_method" value="delete" /><input type="hidden" name="_token" value="'. csrf_token() .'" /><button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button></form>';  
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);  
            }
        }else{
            return redirect()->back();
        }
        
        return view('customers.index');
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
        if($users->user_role != 1){
            return redirect()->back();
        }else{
            return view('customers.create');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'date_of_birth' => 'nullable|date|max:255',
            'opening_balance' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
            'zip_code' => 'nullable|max:255',
            'status' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer = New Customer;
        
        $customer->name=$request->name;
        $customer->user_id=Auth::id();
        $customer->email=$request->email;
        $customer->phone=$request->phone;
        $customer->date_of_birth=$request->date_of_birth;
        $customer->opening_balance=$request->opening_balance;
        $customer->address=$request->address;
        $customer->city=$request->city;
        $customer->state=$request->state;
        $customer->country=$request->country;
        $customer->zip_code=$request->zip_code;
        $customer->status=$request->status;
        $customer->save();

        return redirect()->route('customers.lists')->with('success','customer created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $users = Auth::user();
        if($users->user_role != 1){
            return redirect()->back();
        }else{
        return view('customers.edit',compact('customer'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->name=$request->name;
        $customer->email=$request->email;
        $customer->phone=$request->phone;
        $customer->date_of_birth=$request->date_of_birth;
        $customer->opening_balance=$request->opening_balance;
        $customer->address=$request->address;
        $customer->city=$request->city;
        $customer->state=$request->state;
        $customer->country=$request->country;
        $customer->zip_code=$request->zip_code;
        $customer->status=$request->status;
        $customer->save();

        return redirect()->route('customers.lists')->with('success','supplier created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $users = Auth::user();
        if($users->user_role != 1){
            return redirect()->back();
        }else{
        Customer::findOrFail($id)->delete();
     
        return redirect()->back()->with('success','Customer deleted successfully!');
        }
    }
}