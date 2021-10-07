<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends BaseController
{
    //登录
    public function login (LoginRequest $request)
    {
        //检查用户状态
        $credentials = request ([ 'email', 'password' ]);
        if (!$token = auth ('api')->attempt ($credentials)) {
            return response ()->json ([ 'error' => 'Unauthorized' ], 401);
        }
        //检查用户状态
        $user = auth('api')->user ();
        if($user->is_locked==1){
            return $this->response->errorForbidden ("用户已被锁定，无法登录");
        }
        return $this->respondWithToken ($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me ()
    {
        return response ()->json (auth ('api')->user ());
    }

    /**
     * 退出登录
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout ()
    {
        auth ('api')->logout ();

        return response ()->json ([ 'message' => 'Successfully logged out' ]);
    }

    /**
     * 刷新TOKEN
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh ()
    {
        return $this->respondWithToken (auth ('api')->refresh ());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken ($token)
    {
        return response ()->json ([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth ('api')->factory ()->getTTL () * 60
        ]);

        //使用Dingo的内置方法
        return $this->response->array (
            array (
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth ('api')->factory ()->getTTL () * 60
            )
        );
    }
}
