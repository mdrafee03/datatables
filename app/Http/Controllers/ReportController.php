<?php

namespace App\Http\Controllers;
use App\Book;
use App\Customer;
use App\Cart;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function index()
    {
        return view('reports.index');

    }
    public function salesDataTable(Datatables $datatables)
    {
        $cart = Cart::get();
        // dd($cart);           
        // $cart = DB::table('carts')
        //             ->join('book_cart', 'cart_id', '=', 'book_cart.cart_id')
        //             ->select('carts.id', 'carts.created_at', 'carts.subtotal', 'carts.total', 'carts.balance', 'book_cart.sellOrReturn', 'book_cart.price', 'book_cart.quantity', 'book_cart.discount')
        //             ->get();
        return $datatables->of($cart)->toJson();

    }
    public function getCardDetailSales($id){
        $cart = Cart::find($id);
        // $pivotBook = $cart->books;
        // echo $cart;
        foreach($cart->books as $book){
            echo $book->pivot->price;
        }
        // echo $pivotBook;
        // return Cart::find($id)->load('books');
        // return $pivotBook;
    }
    public function salesDetail()
    {
        
        return view('reports/salesDetail');
    }
}
