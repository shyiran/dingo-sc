<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo (User::class,'user_id','id');
    }

    public function goods(){
        return $this->belongsTo (Good::class,'goods_id','id');
    }
}
