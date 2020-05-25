<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    public function product($value='')
    {
    	return $this->belongsTo(Product::class);
    }
}
