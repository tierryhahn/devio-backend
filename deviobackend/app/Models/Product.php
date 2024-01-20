<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'price', 'category', 'description', 'image'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
