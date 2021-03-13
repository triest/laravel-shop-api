<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAddProductToCart;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Services\CartService;
use http\Env\Response;
use Illuminate\Http\Request;

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
}
