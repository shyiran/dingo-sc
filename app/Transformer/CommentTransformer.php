<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 14:19
 */

namespace App\Transformer;


use App\Models\Comment;

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
        ];
    }
}
