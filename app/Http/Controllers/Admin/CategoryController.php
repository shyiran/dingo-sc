<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $type = $request->input ('type');
        if ($type == 'all') {
            return cache_category_all ();
        } else {
            return cache_category ();
        }
    }

    /**
     * 添加分类
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //校验数据
        $inserData = $this->checkInputData ($request);
        if (!is_array ($inserData)) {
            return $inserData;
        }
        Category::create ($inserData);
        return $this->response->created ();
    }

    /**
     * 分类详情
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show (Category $category)
    {
        return $category;

    }

    /**
     * 更新分类
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Category $category)
    {
        //校验数据
        $check_res = $this->checkInputData ($request);
        if (!is_array ($check_res)) {
            return $check_res;
        }
        $category->update ($check_res);
        return $this->response->noContent ();
    }

    /*
     * 检查参数
     */
    protected function checkInputData ($request)
    {
        $request->validate ([
            'name' => 'required|max:16'
        ], [
            'name.required' => '分类名称不能为空'
        ]);
        $pid = $request->input ('pid', 0);
        //计算最大LEVEL
        $level = $pid == 0 ? 1 : (Category::find ($pid)->level + 1);
        if ($level > 3) {
            return $this->response->errorBadRequest ("分类不能超过三级");
        }
        return array (
            'name' => $request->input ('name'),
            'pid' => $pid,
            'level' => $level,
        );;
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
     * 禁用和启用
     */
    public function status (Category $category)
    {
        $category->status = $category->status == 1 ? 0 : 1;
        $category->save ();
        return $this->response->noContent ();
    }
}
