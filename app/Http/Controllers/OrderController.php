<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){

        $cart=Cart::get();

        return response()->json($cart);
    }



    //
    public function store(Request $request){
            $user=Auth::user();
            if(!$user){
                $message='';
                if(!$request->phone){
                  $message.= "Not phone. ";

                }else{
                    $phone=$request->phone;
                }
                if(!$request->name){
                    $message.= "Not name.";
                }else{
                    $name=$request->name;
                }
                if($message!='') {
                    return response()->json(['result' => false, 'message' => $message])->setStatusCode(422);
                }
            }else{
                $phone=$user->phone;
                $name=$user->name;
            }

            //подтягивать из карточки продукты
             $product_card_id=$request->product_cart;

            $product_cards=CartProduct::select(['*'])->whereIn('cart_id',$product_card_id)->with('cart','product')->get();

            if($product_cards->isEmpty()){
                return response()->json(['result'=>false,'message'=>'Product cars is empty'])->setStatusCode(422);
            }


            $order=new Order();
            $order->name=$name;
            $order->phone=$phone;

            $message='';

            if(!$order->phone){
               $message.='Phone not found.';
            }

           if(!$order->name){
               $message.='Name not found.';
           }

            if($message!=''){
                return response()->json(['result'=>false,'message'=>$message])->setStatusCode(422);
            }

            $order->save();


            //добавляем к заказу ис Cart_product
            foreach ($product_cards as $product_card){
                $product_order=new OrderProduct();
                $product=Product::select(['*'])->where('id',$product_card->product_id)->first();

                $product_order->order()->associate($order);
                $product_order->product()->associate($product);
                $product_order->save();
            }

            $order=Order::select(['*'])->with('orderProduct')->where('id',$order->id)->first();

            return response()->json($order);
    }
}
