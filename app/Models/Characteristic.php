<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function characteristicType(){
        return $this->belongsTo(Product::class)->with('type');
    }

    public function type(){
        return $this->belongsTo(CharacteristicType::class);
    }
}
