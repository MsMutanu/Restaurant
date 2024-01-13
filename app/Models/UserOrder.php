<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;
    protected $table='userorders';

    protected $fillable=
    [
        'status',
        'subtotal',
        'tax',
        'total',
        'firstname',
        'lastname',
        'country',
        'city',
        'email',
        'phone',
        'payment_method',
        'order_payment_status',


    ];
    // public function item()
    // {
    //     return $this->belongsTo('App\Models\Item');
    // }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'carts','userorder_id', 'item_id')->withPivot('quantity');
    }
    public function table()
    {
        return $this->belongsTo(RestaurantTables::class, 'table_id', 'id');
    }

}
