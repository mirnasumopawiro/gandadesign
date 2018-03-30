<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemDescVal extends Model
{
    public $incrementing = false;
    protected $casts = [
    	'id' => 'string'
    ];

    protected $primaryKey = "id";
}
