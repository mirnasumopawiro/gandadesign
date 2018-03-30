<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = "categories";
    protected $fillable = [
    	'id', 'name'
    ];

    protected $casts = [
    	'id' => 'string'
    ];

    protected $primaryKey = "id";

    public function subCategories(){
    	return $this->hasMany('App\subCategory');
    }
}
