<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikal extends Model
{
    //
	public function mj(){
		return $this->belongsTo('App\Mjerna','jedmj');
	}
	public function us(){
		return $this->belongsTo('App\User','user');
	}
    protected $table = 'artikli';

}
