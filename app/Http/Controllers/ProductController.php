<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestProductFilter;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public $productService=null;

    /**
     * ProductController constructor.
     * @param null $productService
     */
    public function __construct()
    {
        $this->productService = new ProductService();
    }


    public function filter(RequestProductFilter $request){

        $this->productService->price_max=$request->price_max;
        $this->productService->price_min=$request->price_min;
        $this->productService->category_id_array=$request->category_id;
        $this->productService->characteristic_array=$request->characteristic;

        $filtered_products=$this->productService->filter();

        return response()->json(['result'=>true,'data'=>$filtered_products]);
    }

    public function slug($slug){

        $product=Product::select(['*'])->where('slug',$slug)->first();
        return response()->json(['result'=>true,'date'=>$product]);
    }
}
