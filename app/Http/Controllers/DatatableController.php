<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Customer;


class DatatableController extends Controller
{
    //
    public function getCustomers()
    {
        $customer = Customer::all();

        return Datatables::of($customer)
            ->addColumn('action', function($customer)
            {
                  return view('customers.datatables', compact('customer'))->render();
            })->make(true);

    }
}
