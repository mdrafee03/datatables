<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Customer;
use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function create()
    {
        $books = Book::get();
        $customers = Customer::get();
        return view('carts/create', compact('books', 'customers'));
    }
}
