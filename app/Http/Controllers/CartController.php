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
        $currentBalance = (Float)$request->totalBalance;
        $customerBalance = Customer::find($request->customer_id);
        $customerBalance->balance = $currentBalance;
        $customerBalance->save();

        $cart = Cart::create([
            'customer_id' => $request->customer_id,
            'price' => $request->totalAmount,
            'discount' => $request->discount,  
        ]);
        foreach ($request->book_id as $key => $book_id){
            
           $bookId = $request->book_id[$key];
            $cartId = $cart->id;
            $saleQuantity = $request->inputQty[$key];
            $sellOrReturn = $request->sellOrReturn[$key];
            $price = Book::find($bookId)->price;
            $book_quantity = Book::find($bookId);
           
            
            DB::table('book_cart')->insert([
                'book_id'=> $bookId,
                'cart_id' => $cart->id, 
                'sellOrReturn'=> $sellOrReturn, 
                'quantity'=> $saleQuantity,
                'price' => $price,
                'created_at' =>now(),
                'updated_at' =>now(),
                ]);

            if($sellOrReturn == "sell"){
                $book_quantity->quantity = $book_quantity->quantity - (int)$saleQuantity;
            }
            else{
                $book_quantity->quantity = $book_quantity->quantity + (int)$saleQuantity;
            }
            $book_quantity->save();
            
        } 
        
    }
}
