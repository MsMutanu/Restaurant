<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InventoryLevel
 * 
 * @property string $inventory_id
 * @property string $product_id
 * @property int $instock_quantity
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class InventoryLevel extends Model
{
	protected $table = 'InventoryLevels';
	protected $primaryKey = 'inventory_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'instock_quantity' => 'int'
	];

	protected $fillable = [
		'product_id',
		'instock_quantity'
	];

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}
}
