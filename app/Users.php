<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	public static function notApproved(){
		return static::where('approved','0')->get();
	}

	protected $hidden = [
        'password', 'remember_token',
    ];
    
	public static function makeApprove($id){
		$biodata = static::find($id);
		$biodata->approved = true;
		return $biodata;
	}

	public function mhs(){
		return $this->hasOne('App\Mahasiswa', 'users_id');
	}

	public function dos(){
		return $this->hasOne('App\Dosen', 'users_id');
	}

	public function bimbingan(){
		return $this->hasMany('App\Bimbingan', 'users_id');
	}
}