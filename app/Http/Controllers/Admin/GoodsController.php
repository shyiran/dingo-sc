<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
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
    public function index(Request $request)
    {
        //
        $goods = Good::paginate(3);
        return $this->response->paginator ($goods,new GoodTransformer());

    }

    /**
     * 添加商品
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //校验分类信息
        $category = Category::find($request->category_id);
        if(!$category){
            return $this->response->errorBadRequest ('分类不存在');
        }
        if($category->status==0){
            return $this->response->errorBadRequest ('分类被禁用');
        }
        if($category->level !=3){
            return $this->response->errorBadRequest ('只能向三级分类添加');
        }
        //
        $user_id=auth('api')->id ();

        //$insertData = $request->all();
        //$insertData['user_id']=$user_id;
        //Good:create($insertData);

        $request->offsetSet ('user_id',$user_id);
        Good::create($request->all());
        return $this->response->created ();
    }

    /**
     * 详情
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 更新商品
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /*
     * 是否上架
     */
    public function isOn(){

    }
    /*
     * 是否推荐
     */
    public function isRecommend(){

    }
}
