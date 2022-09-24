<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\OrderRepositoryInterface;
use App\Http\Controllers\MainController;
class OrderController extends MainController
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository) 
    {
        $this->orderRepository = $orderRepository;
    }

    public function sendOrder(Request $req)
    {
        try{
            $validatorArr = array();
            $validatorArr["pack_id"] = 'required|string';
            $validatorArr["discount_amount"] = 'required|numeric';

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }
           $user = $req->user();
           $req->request->add([
            "user_id" => $user->id
            ]);
           $order = $this->orderRepository->sendOrder($req);
           //return $data;
           return response()->json(["errorCode" => 0, "message" => 'Success', "order" => $order]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "order" => null);
        }
        
    }
   


}
