<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    function product(){
        return $this->hasMany(Product::class);
    }


    public function parent()
    {
        return $this->hasOne(Category::class, 'parent_id','id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id','id');
    }

    public function childrenTree()
    {
        return $this->children()->with('children');
    }

}
