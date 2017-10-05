<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    protected $table = "bimbingan";

    public function user(){
    	return $this->belongsTo('App\Users', 'users_id');
    }
}
