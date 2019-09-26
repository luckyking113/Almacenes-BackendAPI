<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    public $timestamps = false;
    protected $primaryKey = 'category_id'; 
    
    public function products()
    {
        return $this->hasMany('App\Product','category_id','category_id');
    }
}
