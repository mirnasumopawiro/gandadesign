<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'subcategories';
    protected $fillable = [
    	'id', 'categories_id', 'name'
    ];

    protected $casts = [
    	'id' => 'string'
    ];

    protected $primaryKey = "id";

    public function subCategories(){
    	return $this->belongsTo('App\Category');
    }


}
