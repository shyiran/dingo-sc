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
    /* public function __construct ()
     {
         $this->middleware ('auth:api', [ 'except' => [ 'login', 'refresh' ] ]);
     }*/
    public function index ()
    {
        return array ( [ '0' => "ssssssssssssssss" ] );
    }

    public function name ()
    {
        $url = app ('Dingo\Api\Routing\UrlGenerator')->version ('v1')->route ('test.name');
        return $url;
    }
    public function users ()
    {
        return User::all ();
    }
}
