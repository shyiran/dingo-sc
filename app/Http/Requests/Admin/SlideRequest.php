<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class SlideRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
            //
            'title' => 'required',
            'img' => 'required',
        ];
    }

    public function message ()
    {
        return [
            'title.required' => '标题 必填',
            'img.required' => '图片 地址必填'
        ];
    }
}
