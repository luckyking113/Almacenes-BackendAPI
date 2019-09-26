<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   public function group()
   {
        return $this->hasOne('App\Group','id','group_id');
   }
   public function warehouse()
   {
        return $this->hasOne('App\Warehouse','id','warehouse_id');
   }
   public function shift()
   {
        return $this->hasOne('App\UserShift','id','user_id');
   }
   public function type()
   {
        return $this->hasOne('App\UserType','id','user_type');
   }
   public function orders()
   {
        return $this->hasMany('App\Order','user_id','id');
   }
   public function deliver_orders()
   {
        return $this->hasMany('App\Order','deliverman_id','id');
   }
}
