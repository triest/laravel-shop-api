<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $hidden=['cookie'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }

    public function cartProduct(){
        return $this->hasMany(CartProduct::class,'cart_id','id');
    }

    public function cartProductWithProduct(){
        return $this->hasMany(CartProduct::class,'cart_id','id')->with('product');
    }

    public static function get(){
        if($user=Auth::user()){

            $cart=$user->cart()->with('cartProductWithProduct')->first();
            if(!$cart){
                $cart=new Cart();
                $cart->user()->associate($user);
                $cart->save();
            }
        }else{
            if (!isset($_COOKIE["cart_cookie"])) {
                $_COOKIE["cart_cookie"] = Cart::randomString(64);
                $cart=Cart::generateCart($_COOKIE["cart_cookie"]);
            }else{
                $cookie = $_COOKIE["cart_cookie"];
                $cart = Cart::select(['*'])
                        ->where("cookie", "=", $cookie)
                        ->orderBy('created_at', 'desc')
                        ->with('cartProductWithProduct')
                        ->first();
                if(!$cart){
                    $_COOKIE["cart_cookie"] = Cart::randomString(64);
                    $cart=Cart::generateCart($_COOKIE["cart_cookie"]);
                }
            }
        }
        return $cart;
    }

    public static function generateCart($cookie){
        $cart=new Cart();
        $cart->cookie=$cookie;
        $cart->save();
        return $cart;
    }


    public static function randomString($length = 64)
    {
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str = "";

        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        $str = substr(base64_encode(sha1(mt_rand())), 0, $length);

        return $str;
    }


}
