<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 14:19
 */

namespace App\Transformer;


use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform (User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'emil' => $user->email,
            'created_at' => $user->created_at,
            'update_at' => $user->update_at,
        ];
    }
}
