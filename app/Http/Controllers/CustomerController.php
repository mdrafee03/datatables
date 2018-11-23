<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index');

    }
    public function data(Datatables $datatables)
    {
        $query = Customer::query();

        return $datatables->eloquent($query)
            ->addColumn('action', function($customer)
            {
                  return view('customers.actions', compact('customer'))->render();
            })->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'mobile' => 'required',
            'university' => 'required',
        ]);
        $data = array_filter($request->all());
        Customer::create($data);

        Session::flash('message', $data['name'] . ' added successfully');
        return redirect('/customers');

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
        $customer = Customer::find($id);
        return view('customers.edit',['customer' => $customer]);
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
        $customer = Customer::find($id);
        $data = $request->all();
        $customer->update($data);

        Session::flash('message', $data['name'].  ' updated successfully');
        return redirect('/customers');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $customer = Customer::find($id);
        $customer->destroy($id);

        Session::flash('message', $customer['name'].  ' deleted successfully');
        return redirect('/customers');
    }

}
