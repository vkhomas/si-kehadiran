<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KKeahlian extends Model
{
    protected $table = "keahlian";

    public function jurusan(){
    	return $this->belongsTo('App\Jurusan', 'jurusan_id', 'jurusan_id');
    }
}
