<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Transformer\UserTransformer;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        //如果存在搜索条件
        $name = $request->input ("name");
        $email = $request->input ("email");

        $users = User::when ($name, function ($query) use ($name) {
                $query->where ('name', 'like', "%$name%");
            })
            ->when ($email, function ($query) use ($email) {
                $query->where ('email', $email);
            })
            ->paginate (4);
        return $this->response->paginator ($users, new UserTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show (User $user)
    {
        //用户详情
        return $this->response->item ($user, new UserTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        //
    }

    /*
     * 锁定(禁用或者启用)用户
     */
    public function lock (User $user)
    {
        $user->is_locked = $user->is_locked == 0 ? 1 : 0;
        $user->save ();
        return $this->response->noContent ();
    }
}
