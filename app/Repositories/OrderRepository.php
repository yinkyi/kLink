<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Order;
use Illuminate\Support\Str;

class OrderRepository implements OrderRepositoryInterface 
{
    public function sendOrder($request) 
    {
        $param = array(
            "order_id"=>Str::uuid()->toString(),
            "pack_id"=>$request->pack_id,
            "user_id"=>$request->user_id,
            "discount_amount"=>$request->discount_amount
        );
        $order = Order::create($param);

        return $order;
    }


    
}