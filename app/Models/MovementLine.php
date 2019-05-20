<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovementLine extends Model
{
	public $timestamps = false;

	public function movement()
	{
		return $this->hasOne(Movement::class, 'id');
	}
	
	public function product()
	{
		return $this->hasOne(Product::class, 'id');
	}

	public function locationFrom()
	{
		return $this->hasOne(Location::class, 'id');
	}
	
	public function locationTo()
	{
		return $this->hasOne(Location::class, 'id');
	}
}
