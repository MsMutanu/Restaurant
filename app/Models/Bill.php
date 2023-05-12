<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bill
 * 
 * @property string $bill_id
 * @property string $cust_id
 * @property string $order_id
 * @property int $resttable_no
 * @property Carbon $created_at
 * @property float $total
 * @property int $waiter_no
 * 
 * @property Customer $customer
 * @property Order $order
 * @property RestaurantTable $restaurant_table
 * @property Waiter $waiter
 *
 * @package App\Models
 */
class Bill extends Model
{
	protected $table = 'Bill';
	protected $primaryKey = 'bill_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'resttable_no' => 'int',
		'total' => 'float',
		'waiter_no' => 'int'
	];

	protected $fillable = [
		'cust_id',
		'order_id',
		'resttable_no',
		'total',
		'waiter_no'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'cust_id');
	}

	public function order()
	{
		return $this->belongsTo(Order::class, 'order_id');
	}

	public function restaurant_table()
	{
		return $this->belongsTo(RestaurantTable::class, 'resttable_no', 'resttable_no');
	}

	public function waiter()
	{
		return $this->belongsTo(Waiter::class, 'waiter_no', 'waiter_no');
	}
}
