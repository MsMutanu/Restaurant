<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


class RestaurantTables extends Model
{
    use HasFactory;

	protected $table = 'restauranttables';
    protected $fillable = ['name', 'capacity', 'status'];

   



	public function Userorder()
	{
		return $this->hasMany('App\Models\Userorder');
	}

	public function reservation()
	{
		return $this->hasMany('App\Models\reservation');
	}
}
