<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductName
 * 
 * @property string $name_id
 * @property string $product_name
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class ProductName extends Model
{
	protected $table = 'ProductNames';
	protected $primaryKey = 'name_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'product_name'
	];

	public function products()
	{
		return $this->hasMany(Product::class, 'name_id');
	}
}
