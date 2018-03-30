<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public $incrementing = false;
    protected $casts = [
    	'id' => 'string'
    ];

    protected $primaryKey = "id";
}
