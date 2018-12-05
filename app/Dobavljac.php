<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dobavljac extends Model
{
	public function us(){
		return $this->belongsTo("App\User","userid");
	}
	protected $table='dobavljaci';
}
