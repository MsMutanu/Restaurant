<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    // public function items()
    // {
    //     return $this->hasMany('App\Models\Item');
    // }


        // public function items()
        // {
        //     return $this->belongsToMany(Item::class, 'cart_item')
        //         ->withPivot('quantity');
        // }



}
