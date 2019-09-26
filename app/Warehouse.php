<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
   public function user()
   {
        return $this->hasOne('App\User','warehouse_id','id');
   }
   
    public function users()
   {
        return $this->hasMany('App\User','warehouse_id','id');
   }
}
