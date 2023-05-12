<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCategory
 * 
 * @property string $category_id
 * @property string $category
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class ProductCategory extends Model
{
	protected $table = 'ProductCategory';
	protected $primaryKey = 'category_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'category'
	];

	public function products()
	{
		return $this->hasMany(Product::class, 'category_id');
	}
}
