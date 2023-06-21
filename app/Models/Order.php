<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property string $order_id
 * @property string $cust_id
 * @property int $resttable_no
 * @property int $waiter_no
 * @property Carbon|null $date_time
 * @property string $status
 * @property int $order_amount
 * 
 * @property RestaurantTable $restaurant_table
 * @property Waiter $waiter
 * @property Customer $customer
 * @property Collection|Bill[] $bills
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'Order';
	protected $primaryKey = 'order_id';
	
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'resttable_no' => 'int',
		
		'date_time' => 'datetime',
		'order_amount' => 'int'
	];

	protected $fillable = [
		'cust_id',
		'resttable_no',
		'waiter_no',
		'date_time',
		'status',
		'order_amount'
	];

	public function restaurant_table()
	{
		return $this->belongsTo(RestaurantTable::class, 'resttable_no', 'resttable_no');
	}

	public function waiter()
	{
		return $this->belongsTo(Waiter::class, 'waiter_no', 'waiter_no');
	}

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'cust_id');
	}

	public function bills()
	{
		return $this->hasMany(Bill::class, 'order_id');
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class, 'order_id');
	}
}
