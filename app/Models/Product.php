<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use GeneratesUuid;
	use SoftDeletes;

	protected $casts = ['uuid' => 'uuid'];

	public function base_unit() {
		return $this->hasOne(Unit::class, 'id', 'base_unit_id');
	}

	public function units() {
		return $this->hasMany(Unit::class, 'unit_id', 'id');
	}
}
