<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware ('auth:api', [ 'except' => [ 'login', 'refresh' ] ]);
    }

    public function test01 ()
    {

    }

    public function index ()
    {
        //$users = User::all ();
        //响应一个数组
        //return $this->response->array($users->toArray());

        //响应一个元素
        // $id='1';
        // $user = User::findOrFail($id);
        // return $this->response->item($user, new UserTransformer);


        //无内容响应
        //return $this->response->noContent();


        //创建了资源的响应
        //return $this->response->created();


        // 一个自定义消息和状态码的普通错误。
        // return $this->response->error('This is an ewrror.', 404);

        //抛出异常
        //throw new \Symfony\Component\HttpKernel\Exception\ConflictHttpException('少时诵诗书所所所所所所');

        //资源异常
        $rules = [
            'username' => [ 'required', 'alpha' ],
            'password' => [ 'required', 'min:7' ]
        ];

        $payload = app ('request')->only ('username', 'password');

        $validator = app ('validator')->make ($payload, $rules);

        if ($validator->fails ()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.', $validator->errors ());
        }

    }

    //
    public function test ()
    {
        return "controller-test";
    }

    public function tests ()
    {
        return "controller-tests";
    }

    public function name ()
    {
        $url = app ('Dingo\Api\Routing\UrlGenerator')->version ('v2')->route ('test.name');
        dd ($url);
    }

    public function users ()
    {
        $id = '1';
        $user = User::findOrFail ($id);
        return $this->response->item ($user, new UserTransformer);
    }

    public function show ()
    {
        dd ("test-showController-show");
    }

    //登录
    public function login (Request $request)
    {
        //$email=$request->input ("email");
        //$password=$request->input ('password');
        $credentials = request ([ 'email', 'password' ]);
        if (!$token = auth ('api')->attempt ($credentials)) {
            return response ()->json ([ 'error' => 'Unauthorized' ], 401);
        }
        return $this->respondWithToken ($token);
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
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh ()
    {
        return $this->respondWithToken (auth ('api')->refresh ());
    }
}
