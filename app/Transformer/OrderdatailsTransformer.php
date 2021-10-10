<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 14:19
 */

namespace App\Transformer;


use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;

class OrderdatailsTransformer
{
    public function transform (OrderDetails $orderDetails)
    {
        return [
            'id' => $orderDetails->id,
            'user_id' => $orderDetails->user_id,
            'goods_id' => $orderDetails->goods_id,
            'price' => $orderDetails->price,
            'num' => $orderDetails->num,
            'created_at' => $orderDetails->created_at,
            'updated_at' => $orderDetails->updated_at,
        ];
    }
}
