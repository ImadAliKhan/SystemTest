<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateEntryRequest;

use Illuminate\Support\Facades\Session;

use App\RevenueType;
use App\RevenueEntry;




class AdminIncomeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $revenue_entries=RevenueEntry::paginate(5);
        return view('admin.report',compact('revenue_entries'));
        
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $revenue_type_id= RevenueType::pluck('name','id')->all();

        return view('admin.create',compact('revenue_type_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEntryRequest $request)
    {
        $input= $request->all();

        RevenueEntry::create($input);

        Session::flash('create_entry','Created Succefully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revenue_entry=RevenueEntry::findOrFail($id);

        $revenue_type_id= RevenueType::pluck('name','id')->all();
        

        return view('admin.edit',compact('revenue_entry','revenue_type_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateEntryRequest $request, $id)
    {
        $input= $request->all();

        $revenue_entry=RevenueEntry::findOrFail($id);


        // return dd($revenue_entry);
        $revenue_entry->update($input);
       return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $revenue_entry=RevenueEntry::findOrFail($id);


        $revenue_entry->delete();

        Session::flash('delete_entry','Deleted Succefully');

        return redirect()->back();
    }

    public function dashboard()
    {
       $total_income= RevenueEntry::where('revenue_type_id', '1')->sum('amount');
       $total_expense= RevenueEntry::where('revenue_type_id', '2')->sum('amount');

       // dd($total_income);
        return view('admin.dashboard',compact('total_income','total_expense'));
    }
    
}
