<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function product(){
        return $this->hasOne(Product::class, 'product_id','id');
    }

    public function orderProduct(){
        return $this->hasMany(OrderProduct::class,'order_id','id');
    }

    public function contactInformationType(){
        return $this->hasMany(ContactInformation::class);
    }

    public function informationType(){
        return $this->hasOne(InformationType::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
