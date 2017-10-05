<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $guarded = [
		'approved',
		'id'
	];

	protected $hidden = [
		'password',
	];
}
