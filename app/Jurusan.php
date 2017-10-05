<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = "jurusan";

    public function kk(){
    	return $this->hasMany('App\KKeahlian', 'jurusan_id', 'jurusan_id');
    }
}
