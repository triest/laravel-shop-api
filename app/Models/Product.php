<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $hidden=['slug'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orders(){
        return $this->morphToMany(Order::class, 'order_product');
    }
}
