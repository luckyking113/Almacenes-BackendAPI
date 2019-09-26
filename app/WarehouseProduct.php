<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseProduct extends Model
{
   public function warehouse()
   {
        return $this->hasOne('App\Warehouse','id','warehouse');
   }
   public function warehousename()
   {
        return $this->hasOne('App\Warehouse','id','warehouse');
   }
}
