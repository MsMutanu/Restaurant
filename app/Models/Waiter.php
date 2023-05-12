<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Waiter
 * 
 * @property string $wait_id
 * @property string $name
 * @property int $contact
 * @property int $waiter_no
 * 
 * @property Collection|Bill[] $bills
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class Waiter extends Model
{
	protected $table = 'Waiter';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'contact' => 'int',
		'waiter_no' => 'int'
	];

	protected $fillable = [
		'name',
		'contact'
	];

	public function bills()
	{
		return $this->hasMany(Bill::class, 'waiter_no', 'waiter_no');
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'waiter_no', 'waiter_no');
	}
}
