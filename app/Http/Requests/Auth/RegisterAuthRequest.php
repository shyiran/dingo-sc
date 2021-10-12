<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;


class RegisterAuthRequest extends BaseRequest
{


    /**
     * 获取应用于请求的验证规则
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|min:2|max:16|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10|confirmed'
        ];
    }
    public function messages ()
    {
        return [
            'name.required'=>'昵称不能为空',
            'name.min'=>'昵称最少不能少于3个字符',
        ];
    }
}
