<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    
   public function category()
   {
        return $this->hasOne('App\Category','category_id','category_id');
   }
   
   public function product_image()
   {
        return $this->hasMany('App\ProductImage','id','product_id');
   }
   public function quantity()
   {
        return $this->hasOne('App\WarehouseProduct','product','id');
   }
   
   public function log_list()
   {
        return $this->hasMany('App\Log','product_id','product');
   }
   
}
