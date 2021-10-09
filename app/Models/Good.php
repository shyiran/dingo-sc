<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;
    //批量操作
    protected $fillable=['user_id','category_id','title','description','price','stock','cover','pics','is_on','is_recommend','details'];
/*
 * 强制类型转换
 */
    protected $casts=[
        'pics'=>'array',

    ];
}
