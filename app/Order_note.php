<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_note extends Model
{
    protected $table = 'order_notes';

    public function order_note(){

        return $this->hasOne('App\Order','id', 'order_id');
    }
}
