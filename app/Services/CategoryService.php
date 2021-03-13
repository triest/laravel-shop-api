<?php


namespace App\Services;


use App\Models\Category;

class CategoryService
{


    public function getCategoryTree(){

        /*
         * получкем родительские категории
         * */

        $categories = Category::with('childrenTree')->whereNull('parent_id')->get();


        return $categories;
    }
}
