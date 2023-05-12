<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InventoryOrderHistory
 * 
 * @property string $invorder_id
 * @property string $product_id
 * @property Carbon $datetime_ordered
 * @property int $amount
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class InventoryOrderHistory extends Model
{
	protected $table = 'InventoryOrderHistory';
	protected $primaryKey = 'invorder_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'datetime_ordered' => 'datetime',
		'amount' => 'int'
	];

	protected $fillable = [
		'product_id',
		'datetime_ordered',
		'amount'
	];

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}
}
