<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	public $timestamps = false;

	public function type()
	{
		return $this->hasOne(LocationType::class, 'id');
	} 
}
