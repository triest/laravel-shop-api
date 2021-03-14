<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $table='cart_product';

    protected $hidden=['card_id'];

    public function cart(){
        return $this->hasOne(Cart::class,'id','cart_id',);
    }

    public function product(){
        return $this->hasOne(Product::class,'id','product_id',);
    }
}
