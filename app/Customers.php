<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customer';

    public function customer_img(){

        return $this->hasOne('App\Approve','customer_id', 'id');
    }
}
