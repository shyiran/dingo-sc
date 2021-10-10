<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 14:19
 */

namespace App\Transformer;


use App\Models\Slide;
use App\Models\User;

class SlideTransformer
{
    public function transform (Slide $slide)
    {
        return [
            'id' => $slide->id,
            'title' => $slide->title,
            'url' => $slide->url,
            'img' => $slide->img,
            'seq' => $slide->seq,
            'status' => $slide->status,
            'created_at' => $slide->created_at,
            'updated_at' => $slide->updated_at,
        ];
    }
}
