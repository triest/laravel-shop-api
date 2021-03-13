<?php


namespace App\Services;


use App\Models\CartProduct;
use App\Models\Product;

class CartService
{
    public $cart;


    public function addProduct(Product $product,$count){

        $cartProduct = CartProduct::select(['*'])->where('cart_id', $this->cart->id)->where(
                'product_id',
                $product->id
        )->first();


        if (!$cartProduct) {
            $this->cart->product()->save($product);
            $cartProduct = CartProduct::select(['*'])->where('cart_id', $this->cart->id)->where(
                    'product_id',
                    $product->id
            )->first();
        }

        $cartProduct->count = $count;
        $cartProduct->save();

        return true;
    }
}
