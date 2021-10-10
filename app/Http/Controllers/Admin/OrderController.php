<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Transformer\OrderTransformer;
use http\Env\Request;


class OrderController extends BaseController
{
    //
    public function index (Request $request)
    {
        $orders = Order::paginate (2);
        return $this->response->paginator ($orders, new OrderTransformer());
    }

    public function show ()
    {

    }

    public function post ()
    {

    }
}
