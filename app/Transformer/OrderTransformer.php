<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 14:19
 */

namespace App\Transformer;


use App\Models\Comment;
use App\Models\Good;
use App\Models\Order;

class OrderTransformer
{
    protected $availableIncludes = ['user','orderDetails'];
    public function transform (Order $order)
    {
        return [
            'id' => $order->id,
            'user_id'=>$order->user_id,
            'order_no'=>$order->order_no,
            'amount'=>$order->amount,
            'status'=>$order->status,

            'address_id'=>$order->address_id,
            'express_type'=>$order->express_type,
            'express_no'=>$order->express_no,
            'pay_time'=>$order->pay_time,


            'pay_type'=>$order->pay_type,
            'trade_no'=>$order->trade_no,
            'created_at'=>$order->created_at,
            'updated_at'=>$order->updated_at,

        ];
    }
    public function includeUser(Order $order){
        return $this->item($order->user,new UserTransformer());
    }
    public function includetails(Order $order){
        return $this->collection($order->orderDetails,new OrderdatailsTransformer());
    }
}
