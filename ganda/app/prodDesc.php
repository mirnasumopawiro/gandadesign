<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prodDesc extends Model
{
    public $incrementing = false;
    protected $casts = [
    	'id' => 'string'
    ];

    protected $primaryKey = "id";
}
