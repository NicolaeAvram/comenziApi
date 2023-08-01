<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    use HasFactory;

    protected $guarded=[];

    public function orders(){
        return $this->belongsToMany(Order::class, 'orders_products');
    }

    public function carts(){
        return $this->belongsToMany(Cart::class, 'carts_products');
    }
}
