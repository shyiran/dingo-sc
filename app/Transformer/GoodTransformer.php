<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 14:19
 */

namespace App\Transformer;



use App\Models\Good;
use League\Fractal\TransformerAbstract;

class GoodTransformer extends TransformerAbstract
{
    protected $availableIncludes = array ( 'category', 'user', 'comments' );

    public function transform (Good $good)
    {
        return [
            'id' => $good->id,
            'title' => $good->title,
            'category_id' => $good->category_id,
           // 'category_name' => Category::find ($good->category_id)->name,
            'user_id'=>$good->user_id,
            'description' => $good->description,
            'price' => $good->price,
            'stock' => $good->stock,
            'cover' => $good->cover,
            'pics' => $good->pics,
            'details' => $good->details,
            'is_on' => $good->is_on,
            'is_recommend' => $good->is_recommend,
            'created_at' => $good->created_at,
            'updated_at' => $good->updated_at,
        ];
    }

    public function includeCategory (Good $good)
    {
        return $this->item($good->category,new CategoryTransformer());
    }
    public function includeUser(Good $good){
        return $this->item($good->user,new UserTransformer());
    }
}
