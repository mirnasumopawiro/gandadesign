<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public $incrementing = false;
    protected $casts = [
    	'id' => 'string'
    ];

    protected $primaryKey = "id";
}
