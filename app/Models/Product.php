<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'image'
    ];

    // Quan hệ với các mục đơn hàng
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
