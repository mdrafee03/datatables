<?php

namespace App\Http\Controllers;
use App\Book;
use App\Customer;
use App\Cart;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        return view('reports.index');

    }
    public function generate()
    {
        return view('reports.generate');
    }
}
