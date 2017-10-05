<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = "mahasiswa";

    public static function makeAlumni($id){
    	$biodata = Mahasiswa::find($id);
    	$biodata->alumni = true;
    	return $biodata; 
    }

    public function user(){
    	return $this->belongsTo('App\User', 'users_id');
    }

    public function hadir(){
    	return $this->hasOne('App\Kehadiran', 'users_id');
    }

    public function bimbingan(){
        return $this->hasMany('App\Bimbingan', 'users_id');
    }
}
