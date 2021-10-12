<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\GoodsRequest;
use App\Models\Category;
use App\Models\Good;
use App\Transformer\GoodTransformer;
use Illuminate\Http\Request;

class GoodsController extends BaseController
{
    /**
     * 商品列表
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        //
        $title = $request->query ('title');
        $category_id = $request->query ('category_id');
        $is_on = $request->query ('is_on', false);
        $is_recommend = $request->query ('is_recommend', false);
        $goods = Good::when ($title, function ($query) use ($title) {
            $query->where ('title', 'like', "%$title%");
        })
            ->when ($category_id, function ($query) use ($category_id) {
                $query->where ('category_id', $category_id);
            })
            ->when ($is_recommend !== false, function ($query) use ($is_recommend) {
                $query->where ('category_id', $is_recommend);
            })->paginate (3);
        return $this->response->paginator ($goods, new GoodTransformer());
    }

    /**
     * 添加商品
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //校验分类信息
        $category = Category::find ($request->category_id);
        if (!$category) {
            return $this->response->errorBadRequest ('分类不存在');
        }
        if ($category->status == 0) {
            return $this->response->errorBadRequest ('分类被禁用');
        }
        if ($category->level != 3) {
            return $this->response->errorBadRequest ('只能向三级分类添加');
        }
        //
        $user_id = auth ('api')->id ();
        //一种方法
        //$insertData = $request->all();
        //$insertData['user_id']=$user_id;
        //Good:create($insertData);

        $request->offsetSet ('user_id', $user_id);
        Good::create ($request->all ());
        return $this->response->created ();
    }

    /**
     * 详情
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show (Good $good)
    {
        //
        return $this->response->item ($good, new GoodTransformer());
    }

    /**
     * 更新商品
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (GoodsRequest $request, Good $good)
    {
        //
        //校验分类信息
        $category = Category::find ($request->category_id);
        if (!$category) {
            return $this->response->errorBadRequest ('分类不存在');
        }
        if ($category->status == 0) {
            return $this->response->errorBadRequest ('分类被禁用');
        }
        if ($category->level != 3) {
            return $this->response->errorBadRequest ('只能向三级分类添加');
        }
        $good->update ($request->all ());
        return $this->response->noContent ();
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
     * 是否上架
     */
    public function isOn (Good $good)
    {
        $good->is_on = $good->is_on == 0 ? 1 : 0;
        $good->save ();
        return $this->response->noContent ();
    }

    /*
     * 是否推荐
     */
    public function isRecommend (Good $good)
    {
        $good->is_recommend = $good->is_recommend == 0 ? 1 : 0;
        $good->save ();
        $this->response->noContent ();
    }
}
