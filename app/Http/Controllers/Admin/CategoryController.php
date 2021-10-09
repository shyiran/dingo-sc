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
    public function index ()
    {
        //
        $categories = Category::select('id','pid','name','level')
            ->where('pid',0)
            ->with([
                'children:id,pid,name,level',
                'children.children:id,pid,name,level'
            ])
            ->get ();
        return $categories;
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
        //
        $request->validate ([
            'name' => 'required|max:16'
        ], [
            'name.required' => '分类名称不能为空'
        ]);
        //  Category::create($request->only (['name','pid']));
        //$inputs = $request->only ([ 'name', 'pid' ]);
        $pid = $request->input ('pid', 0);
        $level = $pid == 0 ? 1 : (Category::find ($pid)->level + 1);
        if ($level > 3) {
            return $this->response->errorBadRequest ("分类不能超过三级");
        }
        $inserData = array (
            'name' => $request->input ('name'),
            'pid' => $pid,
            'level' => $level,
        );
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
    public function show ()
    {
        //Category $category
        //return $category;

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
}
