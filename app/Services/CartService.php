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

    public function deleteProduct(Product $product)
    {
        $cartProduct = CartProduct::select(['*'])->where('cart_id', $this->cart->id)->where(
                'product_id',
                $product->id
        )->first();
        if (!$cartProduct) {
            return "cart product not found";
        }
        $cartProduct->delete();
        return true;
    }
}
