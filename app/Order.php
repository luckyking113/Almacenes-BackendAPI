<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   public function user()
   {
        return $this->hasOne('App\User','id','user_id');
   }
   public function deliverman()
   {
        return $this->hasOne('App\User','id','deliverman_id');
   }
   public function warehouse()
   {
        return $this->hasOne('App\Warehouse','id','warehouse_id');
   }
   public function customer()
   {
        return $this->hasOne('App\Customer','id','customer_id');
   }
   public function order_review()
   {
        return $this->hasOne('App\OrderReview','order_id','id');
   }
    public function customer_shipping()
   {
        return $this->hasOne('App\Tb_shippingaddres','address_id','shipping_addressid');
   }
    public function order_products()
   {
        return $this->hasMany('App\OrderProduct','order_id','id');
   }
}
