<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TakealotSale;
use Carbon\Carbon;
use DB;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $start_day = Carbon::now()->addDays(-7);
        $end_day = Carbon::now();
        if($user->user_role != 2){
        $total_amount = [];

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::create(date('Y'), $month);

            $date_end = $date->copy()->endOfMonth();

            $transaksi = TakealotSale::selectRaw('sum(selling_price) as price')->where('order_date', '>=', $date)
                ->where('order_date', '<=', $date_end)->where('user_id',$user->id)
                ->get()->toArray();

            $total_amount[$month] = $transaksi;
        }

        $total_sale = 0;
        foreach($total_amount as $tamt){
            $total_sale += $tamt[0]['price'];
        }

        $tsales = TakealotSale::selectRaw('sum(selling_price) as price')->where('sale_status','!=','Returned')->where('user_id',$user->id)->get()->toArray();
        $tsales_return = TakealotSale::selectRaw('sum(selling_price) as price')->where('sale_status','Returned')->where('user_id',$user->id)->get()->toArray();

        $day_wise = TakealotSale::selectRaw('sum(selling_price) as price, DATE(order_date) as date')->where('user_id',$user->id)->whereBetween('order_date', [$start_day, $end_day])->groupBy(DB::raw('DATE(order_date)'))->get()->toArray();

        $recent_order = TakealotSale::where('user_id',$user->id)->latest()->take(6)->get();
        $top_selling_product = TakealotSale::selectRaw('sum(quantity) as sale_item, sum(selling_price) as sale_price, product_name')->where('sale_status','!=','Returned')->where('user_id',$user->id)->groupBy('product_name')->orderBy('sale_item','desc')->take(6)->get();
    //    dd($day_wise);
        }else{

            $total_amount = [];

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::create(date('Y'), $month);

            $date_end = $date->copy()->endOfMonth();

            $transaksi = TakealotSale::selectRaw('sum(selling_price) as price')->where('order_date', '>=', $date)
                ->where('order_date', '<=', $date_end)->where('user_id',$user->parent_id)
                ->get()->toArray();

            $total_amount[$month] = $transaksi;
        }

        $total_sale = 0;
        foreach($total_amount as $tamt){
            $total_sale += $tamt[0]['price'];
        }

        $tsales = TakealotSale::selectRaw('sum(selling_price) as price')->where('sale_status','!=','Returned')->where('user_id',$user->parent_id)->get()->toArray();
        $tsales_return = TakealotSale::selectRaw('sum(selling_price) as price')->where('sale_status','Returned')->where('user_id',$user->parent_id)->get()->toArray();

        $day_wise = TakealotSale::selectRaw('sum(selling_price) as price, DATE(order_date) as date')->where('user_id',$user->parent_id)->whereBetween('order_date', [$start_day, $end_day])->groupBy(DB::raw('DATE(order_date)'))->get()->toArray();

        $recent_order = TakealotSale::where('user_id',$user->parent_id)->latest()->take(6)->get();
        $top_selling_product = TakealotSale::selectRaw('sum(quantity) as sale_item, sum(selling_price) as sale_price, product_name')->where('sale_status','!=','Returned')->where('user_id',$user->parent_id)->groupBy('product_name')->orderBy('sale_item','desc')->take(6)->get();
        }

        // dd($top_selling_product);
        return view('dashboard',compact('total_amount','total_sale','tsales','tsales_return','day_wise','recent_order','top_selling_product'));
    }

    public function profile(){
        $users = Auth::user();

        if($users){
            $user = User::find($users->id);
            return view('users.profile',compact('user'));
        }else{
            return redirect()->back();
        }
    }

    public function profile_update(Request $request, $id)
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
            if($users->image){
            unlink(public_path('uploads/users/'.$users->image));
            }
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
        $users->update();

        return redirect()->back()->with('success','User updated successfully!');
    }
}
