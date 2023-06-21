<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * 
 * @property string $orderitems_id
 * @property string $order_id
 * @property string $product_id
 * @property int $quantity
 * 
 * @property Product $product
 * @property Order $order
 *
 * @package App\Models
 */
class OrderItem extends Model
{
	protected $table = 'OrderItems';
	protected $primaryKey = 'orderitems_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'order_id',
		'product_id',
		'quantity'
	];

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	public function order()
	{
		return $this->belongsTo(Order::class, 'order_id');
	}
}
