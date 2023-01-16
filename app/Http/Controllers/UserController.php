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
            $data = User::where('user_role',2)->orWhere('user_role',4)->where('shop_id',$users->shop_id)->latest()->get();
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
        $user_id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
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
        $users->phone=$request->phone;
        $users->password=Hash::make($request->password);
        if($users->user_role == 1){
        $users->user_role=$request->user_role;
        $users->parent_id=$user_id;
        }else{
            $users->user_role=1;
            $users->parent_id=0;
        }
        $users->save();

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
        // dd($request->all());
        $users = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'username' => 'required|unique:users,username,' . $users->id,
            'email' => 'required|email|unique:users,email,' . $users->id,
            'phone' => 'required|number|unique:users,phone,' . $users->id,
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

        $users->fname=$request->fname;
        $users->lname=$request->lname;
        $users->username=$request->username;
        $users->email=$request->email;
        $users->phone=$request->phone;
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
