<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'price', 'category'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
