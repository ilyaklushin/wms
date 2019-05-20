<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLine extends Model
{
	public $timestamps = false;

	public function product()
	{
		return $this->hasOne(Product::class, 'id');
	}

	public function unit()
	{
		return $this->hasOne(Unit::class, 'id');
	}
}
