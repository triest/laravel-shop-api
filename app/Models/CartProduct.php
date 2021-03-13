<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $table='cart_product';

    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function product(){
        return $this->hasOne(Product::class);
    }
}
