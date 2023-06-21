<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property string $product_id
 * @property string $name_id
 * @property string $category_id
 * @property float $product_price
 * @property string $product_details
 * @property int $image
 * 
 * @property ProductName $product_name
 * @property ProductCategory $product_category
 * @property Collection|InventoryLevel[] $inventory_levels
 * @property Collection|InventoryOrderHistory[] $inventory_order_histories
 * @property Collection|Menu[] $menus
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'Product';
	protected $primaryKey = 'product_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'product_price' => 'float'
	];

	protected $fillable = [
		'name_id',
		'category_id',
		'product_price',
		'product_details',
		'image'

	];

	public function product_name()
	{
		return $this->belongsTo(ProductName::class, 'name_id');
	}

	public function product_category()
	{
		return $this->belongsTo(ProductCategory::class, 'category_id');
	}

	public function inventory_levels()
	{
		return $this->hasMany(InventoryLevel::class, 'product_id');
	}

	public function inventory_order_histories()
	{
		return $this->hasMany(InventoryOrderHistory::class, 'product_id');
	}

	public function menus()
	{
		return $this->hasMany(Menu::class, 'product_id');
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class, 'product_id');
	}
}
