<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteProductFromCart;
use App\Http\Requests\RequestAddProductToCart;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Services\CartService;
use GuzzleHttp\Psr7\Request;

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

    public function index(){
        $cart = Cart::get();
        if (!$cart) {
            return response([], 204)->json(['result' => false, 'message' => 'cart not found']);
        }

        $product=$cart->product()->get();

        return response()->json(['result' => $product]);
    }

    public function store(RequestAddProductToCart $request)
    {
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

        return response()->json(['result' => $result])->withCookie('cart_cookie',$cart->cookie);
    }

    public function destroy($product)
    {
        $cart = Cart::get();
        if (!$cart) {
            return response([], 204)->json(['result' => false, 'message' => 'cart not found']);
        }

        $product = Product::select(['*'])->where(['id' => $product])->first();

        if (!$product) {
            return response()->json(['result' => false, 'message' => 'product not found'])->setStatusCode(500);
        }

        $this->cartService->cart = $cart;

        $result = $this->cartService->deleteProduct($product);

        if ($result) {
            return response()->json(['result' => $result]);
        } else {
            return response()->json(['result' => $result]);
        }
    }

    public function getProducts(){
        $cart = Cart::get();

        $cartProduct=CartProduct::select(['*'])->where(['cart_id'=>$cart->id])->with('cart','product')->get();

        return response()->json(['result' => $cartProduct]);
    }
}
