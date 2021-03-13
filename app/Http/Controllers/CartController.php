<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAddProductToCart;
use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;

class CartController extends Controller
{
    public $cartService=null;



    //

    /**
     * CartController constructor.
     * @param null $cartService
     */
    public function __construct()
    {
        $this->cartService = new CartService();
    }

    public function addProduct(RequestAddProductToCart $request)
    {
        // dump($request);
        //Получаем Cart;
        $cart = Cart::get();
        if (!$cart) {
            return response([], 204)->json(['result' => false, 'message' => 'cart not found']);
        }

        $product = Product::select(['*'])->where('id', $request->product_id)->first();

        if (!$product) {
            return response([], 204)->json(['result' => false, 'message' => 'product not found']);
        }

        $this->cartService->cart=$cart;

        $result=$this->cartService->addProduct($product,intval($request->count));

        return response()->json(['result' => $result]);
    }

    public function deleteProduct(RequestAddProductToCart $request){

        $cart = Cart::get();
        if (!$cart) {
            return response([], 204)->json(['result' => false, 'message' => 'cart not found']);
        }


        $product = Product::select(['*'])->where(['id'=> $request->product_id])->first();

        if (!$product) {
            return response()->json(['result' => false, 'message' => 'product not found'])->setStatusCode(500);
        }

        $this->cartService->cart=$cart;

        $result=$this->cartService->deleteProduct($product);

        if($result){
            return response()->json(['result' => $result]);
        }else{
            return response()->json(['result' => $result]);
        }

    }
}
