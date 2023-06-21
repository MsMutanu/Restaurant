<?php

namespace App\Models;

use App\Enums\TableLocation;
use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


class RestaurantTable extends Model
{
    use HasFactory;

	protected $table = 'RestaurantTable';
    protected $fillable = ['name', 'guest_number', 'status', 'location'];

    protected $casts = [
        'status' => TableStatus::class,
        'location' => TableLocation::class
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
		return $this->hasMany(Reservation::class);
	}
}
