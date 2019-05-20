<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeHistoryLine extends Model
{
    public $timestamps = false;

    public function status()
    {
    	return $this->succesful ? "Успешно" : "Ошибка";
    }
}