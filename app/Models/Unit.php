<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
	use GeneratesUuid;
	use SoftDeletes;

	protected $casts = ['uuid' => 'uuid'];

	protected $fillable = ['uuid','name','synchronized_at'];

	public function products() {
		return $this->hasMany(Product::class, 'product_id', 'id');
	}
}
