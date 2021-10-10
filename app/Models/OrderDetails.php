<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    public function orders ()
    {
        return $this->belongsTo (Order::class, 'order_id', 'id');
    }

    public function goods ()
    {
        return $this->hasOne (Good::class, 'goods_id', 'id');
    }

}
