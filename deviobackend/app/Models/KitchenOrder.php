<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitchenOrder extends Model
{
    protected $fillable = ['order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
