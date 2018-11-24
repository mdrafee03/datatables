<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function books()
    {
        return $this->belongsToMany('App\Book');
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer');
    }



}
