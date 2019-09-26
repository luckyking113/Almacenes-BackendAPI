<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function group()
   {
        return $this->hasOne('App\Group','id','group_id');
   }
}
