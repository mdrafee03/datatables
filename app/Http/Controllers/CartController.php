<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Customer;
use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $books = Book::get();
        $customers = Customer::get();
        return view('cart', compact('books', 'customers'));
    }

    public function dataAjax(request $request)
    {
        $data = [];

        if($request->has('q'))
        {
            $search = $request->q;
            $data = DB::table('books')
                        ->select('id', 'title')
                        ->where('title', 'LIKE', "%$search%")
                        ->get();
        }
        return response()->json($data);

    }
}
