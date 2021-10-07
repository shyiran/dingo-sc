<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class ApiController extends Controller
{
    //
    public $loginAfterSignUp = true;

    public function register (RegisterAuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt ($request->password);
        $user->save ();

        if ($this->loginAfterSignUp) {
            return $this->login ($request);
        }

        return response ()->json ([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function login (Request $request)
    {
        $input = $request->only ('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt ($input)) {
            return response ()->json ([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response ()->json ([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function logout (Request $request)
    {
        $this->validate ($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate ($request->token);

            return response ()->json ([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response ()->json ([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser (Request $request)
    {
        $this->validate ($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate ($request->token);

        return response ()->json ([ 'user' => $user ]);
    }
    /*让我解释下上面的代码发生了什么。
    在 register 方法中，我们接收了 RegisterAuthRequest 。使用请求中的数据创建用户。如果 loginAfterSignUp属性为 true ，则注册后通过调用 login 方法为用户登录。否则，成功的响应则将伴随用户数据一起返回。
    在 login 方法中，我们得到了请求的子集，其中只包含电子邮件和密码。以输入的值作为参数调用  JWTAuth::attempt() ，响应保存在一个变量中。如果从 attempt 方法中返回 false ，则返回一个失败响应。否则，将返回一个成功的响应。
    在 logout 方法中，验证请求是否包含令牌验证。通过调用 invalidate 方法使令牌无效，并返回一个成功的响应。如果捕获到 JWTException 异常，则返回一个失败的响应。
    在 getAuthUser 方法中，验证请求是否包含令牌字段。然后调用 authenticate 方法，该方法返回经过身份验证的用户。最后，返回带有用户的响应。
    身份验证部分现在已经完成。
    */
}
