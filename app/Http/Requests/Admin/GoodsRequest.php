<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class GoodsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'user_id'=>'required',
            'category_id'=>'required',
            'title'=>'required|max:50',
            'description'=>'required|max:255',
            'price'=>'required|min:0',
            'stock'=>'required|min:0',
            'cover'=>'required',
            'pics'=>'required|array',
            'details'=>'required',
        ];
    }
}
