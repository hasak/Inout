<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sklapalica extends Model
{
    //
	public function art(){
		return $this->belongsTo("App\Artikal","idart");
	}
	public function pzl(){
		return $this->belongsTo("App\Artikal","idpuzle");
	}
    protected $table='Sklapalica';
}
