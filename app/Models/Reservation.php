<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation
 * 
 * @property string $reserve_id
 * @property string $cust_id
 * @property int $resttable_no
 * @property int $no_of_seats
 * @property Carbon $date
 * @property Carbon $time
 * 
 * @property Customer $customer
 * @property RestaurantTable $restaurant_table
 *
 * @package App\Models
 */
class Reservation extends Model
{
	protected $table = 'Reservation';
	protected $primaryKey = 'reserve_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'resttable_no' => 'int',
		'no_of_seats' => 'int',
		'date' => 'datetime',
		'time' => 'datetime'
	];

	protected $fillable = [
		'cust_id',
		'resttable_no',
		'no_of_seats',
		'date',
		'time'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'cust_id');
	}

	public function restaurant_table()
	{
		return $this->belongsTo(RestaurantTable::class, 'resttable_no', 'resttable_no');
	}
}
