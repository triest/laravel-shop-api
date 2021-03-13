<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestProductFilter;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

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
  //      dump($request);
        $this->productService->price_max=$request->price_max;
        $this->productService->price_mix=$request->price_mix;
        $this->productService->category_id_array=$request->category_id;

        $filtered_products=$this->productService->filter();

        return response()->json(['result'=>true,'data'=>$filtered_products]);
    }

    public function slug($slug){

        $product=Product::select(['*'])->where('slug',$slug)->first();
        return response()->json(['result'=>true,'date'=>$product]);
    }
}
