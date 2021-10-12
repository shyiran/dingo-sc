<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;

use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Models\User;


class RegisterController extends BaseController
{
    /*
     * 用户注册
     */
    public function register(RegisterAuthRequest $request){
        $user =new User();
        $user->name = $request->input ('name');
        $user->email = $request->input ('email');
        $user->password = bcrypt ($request->input('password'));
        $user->save();
        return $this->response->created ();
    }
}
