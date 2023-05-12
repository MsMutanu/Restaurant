<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 * 
 * @property string $menu_id
 * @property string $product_id
 * @property string $product_details
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class Menu extends Model
{
	protected $table = 'Menu';
	protected $primaryKey = 'menu_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'product_id',
		'product_details'
	];

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}
}
