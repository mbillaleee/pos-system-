<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Validator;


class ChartOfAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartofaccounts = ChartOfAccount::where('parent_id',0)->get();
        return view('chart_of_account.create', compact('cartofaccounts'));
           // return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
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
            'name' => 'required|max:255',
            'parent_id' => 'nullable|max:255',
            'opening_balance' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $head = ChartOfAccount::where('id',$request->parent_id)->first();
        $coa = New ChartOfAccount;

        $coa->name=$request->name;
        $coa->parent_id=$request->parent_id;
        $coa->opening_balance=$request->opening_balance;
        $coa->head_type=$head->head_type;
        // $coa->user_id=$user_id;
        $coa->save();

        return redirect()->route('chart_of_account.index')->with('success','Chart of Account created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function show(ChartOfAccount $chartOfAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
	    $chartOfAccount  = ChartOfAccount::where('id', $request->id)->first();
	 
	    return Response()->json($chartOfAccount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChartOfAccount $chartOfAccount)
    {
        
        $caoId = $request->id;

        $shopifys = ChartOfAccount::where('id', $caoId)->update([ 
                    'name' => $request->name, 
                    'opening_balance' => $request->opening_balance
                ]); 
                         
        // Session::flash('success', 'Product updated successfully!');
        return Response()->json($shopifys);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChartOfAccount $chartOfAccount)
    {
        //
    }


}
