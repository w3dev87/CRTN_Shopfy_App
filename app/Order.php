<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    public function products(){

        return $this->hasOne('App\Order_products','order_id', 'order_id');
    }

    public function background(){

        return $this->hasOne('App\Backgrounds','id', 'background_id');
    }

    public function notes(){

        return $this->hasMany('App\Order_note','order_id', 'order_id');
    }

    public function artwork(){

        return $this->hasOne('App\Va_imageses','order_id', 'id');
    }
}
