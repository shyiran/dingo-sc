<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 14:19
 */

namespace App\Transformer;


use App\Models\Good;

class GoodTransformer
{
    protected $availableIncludes=array('category','user','comments');
    public function transform (Good $good)
    {
        return [
            'id' => $good->id,
            'title'=>$good->title,
            'description'=>$good->description,
            'price'=>$good->price,
            'stock'=>$good->stock,
            'cover'=>$good->cover,
            'pics'=>$good->pics,
            'details'=>$good->details,
            'is_on'=>$good->is_on,
            'is_recommend'=>$good->is_recommend,
            'created_at'=>$good->created_at,
            'updated_at'=>$good->updated_at,
        ];
    }
}
