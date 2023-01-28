<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Currency;
use App\Models\Shop;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        
        return Validator::make($data, [
            'business_name' => ['required', 'max:255'],
            'start_date' => ['required', 'max:255'],
            'upload_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'currency' => ['required', 'max:255'],
            'website' => ['nullable', 'max:255'],
            'business_contact' => ['required', 'max:255'],
            'alternate_contact' => ['nullable', 'max:255'],
            'country' => ['required', 'max:255'],
            'state' => ['nullable', 'max:255'],
            'city' => ['required', 'max:255'],
            'zip_code' => ['required', 'max:255'],
            'land_mark' => ['nullable', 'max:255'],
            'time_zone' => ['required', 'max:255'],
            'fname' => ['required', 'max:255'],
            'lname' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'max:255', 'unique:users,phone'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);

        //  $request = request();
        
        //  dd($request->file('upload_logo'));

        $shops = New Shop;
        if(isset($data['upload_logo'])){
        $image = $data['upload_logo'];
        if($image != null)
        {
            $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/shops'), $imagename);
            $shops->upload_logo=$imagename;
        }
        }
        $shops->business_name=$data['business_name'];
        $shops->start_date=$data['start_date'];
        $shops->currency=$data['currency'];
        $shops->website=$data['website'];
        $shops->business_contact=$data['business_contact'];
        $shops->alternate_contact=$data['alternate_contact'];
        $shops->country=$data['country'];
        $shops->state=$data['state'];
        $shops->city=$data['city'];
        $shops->zip_code=$data['zip_code'];
        $shops->land_mark=$data['land_mark'];
        $shops->time_zone=$data['time_zone'];
        
        if($shops->save()){
            return User::create([
                'shop_id' => $shops->id,
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
            ]);

        }
        
    }
}

