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
        $cart = Cart::select(['id', 'created_at', 'subtotal', 'total', 'balance']);
        // dd($cart);           
        // $cart = DB::table('carts')
        //             ->join('book_cart', 'cart_id', '=', 'book_cart.cart_id')
        //             ->select('carts.id', 'carts.created_at', 'carts.subtotal', 'carts.total', 'carts.balance', 'book_cart.sellOrReturn', 'book_cart.price', 'book_cart.quantity', 'book_cart.discount')
        //             ->get();
        return $datatables->of($cart)
                        ->editColumn('created_at', function ($user) {
                            return $user->created_at->format('d/m/y');
                        })
                        ->filterColumn('created_at', function ($query, $keyword) {
                            $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
                        })
                        ->toJson(); 

    }
    public function showChildSales($id){
        $cart = Cart::find($id);
        return view('reports.showChildSales', ['cart' => $cart]);
    }
    public function salesDetail()
    {        
        return view('reports/salesDetail');
    }
}
