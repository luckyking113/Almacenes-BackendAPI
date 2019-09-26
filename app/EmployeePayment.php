<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePayment extends Model
{
   public function warehouse()
   {
        return $this->hasOne('App\Warehouse','id','warehouse_id');
   }
   
   public function user()
   {
        return $this->hasOne('App\User','id','user_id');
   }
   public function employee()
   {
        return $this->hasOne('App\User','id','employee_id');
   }
   public function product()
   {
        return $this->hasOne('App\Product','id','product_id');
   }
}
