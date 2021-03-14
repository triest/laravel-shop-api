<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){

        $user=Auth::user();

        if(!$user){
            return response()->json([])->setStatusCode(403);
        }

        $orders=$user->order()->with('status')->get();

        return response()->json($orders);
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

            $orderService=new OrderService($product_cards,$name,$phone);
            $order=$orderService->makeOrder();

            if(!$order instanceof Order){
                return response()->json(['result'=>false,'message'=>$order])->setStatusCode(422);
            }

            return response()->json($order);
    }
}
