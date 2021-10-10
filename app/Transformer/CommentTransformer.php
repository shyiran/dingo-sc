<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 14:19
 */

namespace App\Transformer;


use App\Models\Comment;
use App\Models\Good;

class CommentTransformer
{
    public function transform (Comment $comment)
    {
        return [
            'id' => $comment->id,
            'content'=>$comment->content,
            'rate'=>$comment->rate,
            'reply'=>$comment->reply,

            'user_id'=>$comment->user_id,
            'goods_id'=>$comment->goods_id,
            'created_at'=>$comment->created_at,
            'updated_at'=>$comment->updated_at,
        ];
    }
    public function includeUser(Comment $comment){
        return $this->item($comment->user,new UserTransformer());
    }
    public function includeGoods(Good $good){
        return $this->item($good->goods,new GoodTransformer());
    }
}
