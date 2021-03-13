<?php


namespace App\Services;


use App\Models\Product;

class ProductService
{
    public $price_min=null;
    public $price_max=null;
    public $category_id_array=[];

    public function filter(){
        $products=Product::select(['*']);
        if($this->price_min){
            $products->where('price','>=',$this->price_min);
        }
        if($this->price_max){
            $products->where('price','<=',$this->price_max);
        }

        if(!empty($this->category_id_array)){
            $products->whereIn('category_id', $this->category_id_array);
        }

        return $products->with('category')->get();
    }
}
