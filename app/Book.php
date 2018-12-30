<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_code', 'title', 'author', 'price_code', 'price', 'quantity', 'status'
    ];

    public function carts()
    {
        return $this->belongsToMany('App\Cart');
    }
}
