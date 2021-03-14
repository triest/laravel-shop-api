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

    public function categoryParent(){
        return $this->belongsTo(Category::class,'id','parent_id')->with('parentTree');
    }

    public function orders(){
        return $this->morphToMany(Order::class, 'order_product');
    }

    public function characteristic(){
        return $this->hasMany(Characteristic::class,'product_id','id');
    }

    public function characteristicType(){
        return $this->hasMany(Characteristic::class,'product_id','id')->with('type');
    }
}
