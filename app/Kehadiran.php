<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = "kehadiran";

    public function user(){
    	return $this->belongsTo('App\Users', 'users_id');
    }

    public function mhs(){
    	return $this->belongsTo('App\Mahasiswa', 'users_id', 'users_id');
    }
}
