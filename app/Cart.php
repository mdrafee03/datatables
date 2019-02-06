<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'customer_id', 'sellOrReturn','price', 'subtotal', 'total', 'balance',
    ];
    protected $with = ['books'];

    public function books()
    {
        return $this->belongsToMany('App\Book');
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer');
    }



}
