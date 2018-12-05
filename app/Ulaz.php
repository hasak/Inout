<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulaz extends Model
{
    //
	public function dobavljaci(){
		return $this->belongsTo('App\Dobavljac','dobavljac')->withDefault(['Ime' => '']);
	}
	public function useri(){
		return $this->belongsTo('App\User','user');
	}
	public function puzle(){
		return $this->belongsTo('App\Puzzle','puzla');
	}
	public function art(){
		return $this->belongsTo('App\Artikal','artikal');
	}
    protected $table="uliz";
}
