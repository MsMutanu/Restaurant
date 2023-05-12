<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property string $cust_id
 * @property string $name
 * @property int $contact
 * 
 * @property Collection|Bill[] $bills
 * @property Collection|Order[] $orders
 * @property Collection|Reservation[] $reservations
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'Customer';
	protected $primaryKey = 'cust_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'contact' => 'int'
	];

	protected $fillable = [
		'name',
		'contact'
	];

	public function bills()
	{
		return $this->hasMany(Bill::class, 'cust_id');
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'cust_id');
	}

	public function reservations()
	{
		return $this->hasMany(Reservation::class, 'cust_id');
	}
}
