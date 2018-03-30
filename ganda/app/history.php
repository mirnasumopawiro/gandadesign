<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    public $incrementing = false;
    protected $casts = [
    	'id' => 'string'
    ];

    protected $primaryKey = "id";
}
