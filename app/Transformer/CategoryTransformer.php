<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 14:19
 */

namespace App\Transformer;


use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{

    public function transform (Category $category)
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
        ];
    }


}
