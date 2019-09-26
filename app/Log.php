<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Log extends Model

{

   public function warehouse()

   {

        return $this->hasOne('App\Warehouse','id','warehouse_id');

   }

   public function product()

   {

        return $this->hasOne('App\Product','id','product_id');

   }
   
   public function receive_user()

   {

        return $this->hasOne('App\User','id','received_user');

   }

}

