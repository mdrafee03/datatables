<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'customer_id','price', 'subtotal', 'total', 'balance',
    ];
    public function books()
    {
        return $this->belongsToMany('App\Book');
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer');
    }



}
