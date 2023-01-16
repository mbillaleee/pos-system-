<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
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
            $data = User::where('user_role',2)->where('parent_id',$users->id)->latest()->get();
            return view('users.index',compact('data'))
            ->with('i', 1);
        }else if($users->user_role == 3) {
            $data = User::latest()->get(); 
            return view('users.index',compact('data'))
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
        $users = Auth::user();
        if($users->user_role == 2 && $users->user_role == 4){
            return redirect()->back();
        }else{
            return view('users.create');
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
        dd($request->all());
        //  $user_id = Auth::user()->id;
        // $shop_id = Auth::user()->shop_id;
        // $shop_id = Auth::user->get();

        $validator = Validator::make($request->all(), [
            'business_name' => 'required|max:255',
            'start_date' => 'required|max:255',
            'upload_logo' => 'nullable',
            'currency' => 'required|unique:users,username',
            'website' => 'required|email|unique:users,email',
            'business_contact' => 'required|number|unique:users,phone',
            'alternate_contact' => 'required|same:confirm-password',
            'counntry' => 'nullable',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'zip_code' => 'required|unique:users,username',
            'land_mark' => 'required|email|unique:users,email',
            'time_zone' => 'required|number|unique:users,phone',
            
            
            
            
            
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|number|unique:users,phone',
            'password' => 'required|same:confirm-password',
            'image' => 'nullable',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $shop = New Shop;

        $upload_logo = $request->file('upload_logo');
            if($upload_logo != '')
            {
                $upload_logo_name = pathinfo($upload_logo->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $upload_logo->getClientOriginalExtension();
                $upload_logo->move(public_path('uploads/users'), $upload_logo_name);
                $users->upload_logo=$upload_logo_name;
            }


        $shop->business_name=$request->business_name;
        $shop->start_date=$request->start_date;
        $shop->currency=$request->currency;
        $shop->website=$request->website;
        $shop->business_contact=$request->business_contact;
        $shop->alternate_contact=$request->alternate_contact;
        $shop->counntry=$request->counntry;
        $shop->state=$request->state;
        $shop->city=$request->city;
        $shop->zip_code=$request->zip_code;
        $shop->land_mark=$request->land_mark;
        $shop->time_zone=$request->time_zone;

        if($purchase->save()){
            $shop_id=$shop->id;

            $users = New User;
            $image = $request->file('image');
            if($image != '')
            {
                $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/users'), $imagename);
                $users->image=$imagename;
            }

            $users->fname=$request->fname;
            $users->lname=$request->lname;
            $users->username=$request->username;
            $users->email=$request->email;
            $users->password=Hash::make($request->password);
            if($users->user_role == 1){
            $users->user_role=$request->user_role;
            $users->shop_id=$shop_id;
            }else{
                $users->user_role=1;
                $users->parent_id=0;
            }
            $users->save();
            
        }



        return redirect()->route('users.index')->with('success','User created successfully!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = Auth::user();
        if($users->user_role == 2){
            if($users->id == $id){
                $user = User::find($id);
                return view('users.edit',compact('user'));
            }else{
                return redirect()->back();
            }
        }else{
            $user = User::find($id);
            return view('users.edit',compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username,' . $users->id,
            'email' => 'required|email|unique:users,email,' . $users->id,
            'password' => 'nullable|same:confirm-password',
            'image' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        $image = $request->file('image');
        if($image != '')
        {
            unlink(public_path('uploads/users/'.$users->image));
            $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/users'), $imagename);
            $users->image=$imagename;
        }

        $users->name=$request->name;
        $users->username=$request->username;
        $users->email=$request->email;
        if($users->password != ''){
            $users->password=Hash::make($request->password);
        }
        if($users->user_role == 1){
            $users->user_role=$request->user_role;
            }else{
                $users->user_role=1;
            }
        $users->update();

        return redirect()->route('users.index')->with('success','User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->back()->with('success','User deleted successfully!');
    }
}
