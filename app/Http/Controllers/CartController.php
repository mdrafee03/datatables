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
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required',
        ]);
        $cart = Cart::create([
            'customer_id' => $request->customer_id,
            'price' => $request->totalAmount,
            'discount' => $request->discount,  
        ]);
        
        foreach($request->book_id as $key => $book_id){
            $bookId = $request->book_id[$key];
            $cartId = $cart->id;
            $quantity = $request->inputQty[$key];
            $sellOrReturn = $request->sellOrReturn[$key];
            $book_quantity = Book::get()[$bookId]->quantity;
            if($sellOrReturn = "sell"){
                $book_quantity = $book_quantity - (int)$quantity;
            }
            else{
                $book_quantity = $book_quantity + (int)$quantity;
            }
            $book_quantity = (string)$book_quantity;
            
            dd($book_quantity);  
            $book_quantity->save();
        }
        
    }
}
