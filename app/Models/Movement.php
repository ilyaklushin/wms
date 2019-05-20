<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movement extends Model
{
	use SoftDeletes;
	use GeneratesUuid;

	protected $casts = ['uuid' => 'uuid'];
	
	public function type()
	{
		return $this->hasOne(MovementType::class, 'id');
	}

	public function lines()
	{
		return $this->hasMany(MovementLine::class, 'movement_id', 'id');
	}
}
