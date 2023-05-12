<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RestaurantTable
 * 
 * @property string $resttable_id
 * @property int $resttable_no
 * @property string $availability
 * @property int $capacity
 * 
 * @property Collection|Bill[] $bills
 * @property Collection|Order[] $orders
 * @property Collection|Reservation[] $reservations
 *
 * @package App\Models
 */
class RestaurantTable extends Model
{
	protected $table = 'RestaurantTable';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'resttable_no' => 'int',
		'capacity' => 'int'
	];

	protected $fillable = [
		'availability',
		'capacity'
	];

	public function bills()
	{
		return $this->hasMany(Bill::class, 'resttable_no', 'resttable_no');
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'resttable_no', 'resttable_no');
	}

	public function reservations()
	{
		return $this->hasMany(Reservation::class, 'resttable_no', 'resttable_no');
	}
}
