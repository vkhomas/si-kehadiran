<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = "dosen";

   	protected $hidden = [
        'password', 'remember_token',
    ];

    public function user(){
    	return $this->belongsTo('App\User', 'users_id');
    }
}
