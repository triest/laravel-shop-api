<?php


namespace App\Services;


use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public $product_cards;
    public $name;
    public $phone;

    /**
     * OrderService constructor.
     * @param $product_cards
     * @param $name
     * @param $phone
     */
    public function __construct($product_cards, $name, $phone)
    {
        $this->product_cards = $product_cards;
        $this->name = $name;
        $this->phone = $phone;
    }


    public function makeOrder(){

        $order=new Order();
        $order->name=$this->name;
        $order->phone=$this->phone;

        $message='';

        if(!$order->phone){
            $message.='Phone not found.';
        }

        if(!$order->name){
            $message.='Name not found.';
        }

        if($message!=''){
               return $message;
        }


        if($user=Auth::user()){
            $order->user()->associate($user);
        }
        $order->save();

        //добавляем к заказу ис Cart_product
        foreach ($this->product_cards as $product_card){
            $product_order=new OrderProduct();
            $product=Product::select(['*'])->where('id',$product_card->product_id)->first();
            $product_order->order()->associate($order);
            $product_order->product()->associate($product);
            $product_order->save();

            $product_card->delete();
            /*
             * удаляем из корзины
             * */
        }

        $order=Order::select(['*'])->with('orderProduct')->where('id',$order->id)->first();
    }
}
