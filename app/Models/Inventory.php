<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
	use SoftDeletes;
	use GeneratesUuid;

	protected $casts = ['uuid' => 'uuid'];

	public function lines()
	{
		return $this->hasMany(InventoryLine::class, 'inventory_id', 'id');
	}
}