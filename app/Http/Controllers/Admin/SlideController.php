<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\SlideRequest;
use App\Models\Slide;
use App\Transformer\SlideTransformer;
use Illuminate\Http\Request;

class SlideController extends BaseController
{
    /**
     * 列表
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        //
        $slider = Slide::paginate(2);
        return $this->response->paginator ($slider,new SlideTransformer());
    }

    /**
     * 轮播图添加
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (SlideRequest $request)
    {
        //.
        $max_seq = Slide::max ('seq') ?? 0;
        $max_seq++;
        $request->offsetSet ('seq',$max_seq);
        Slide::create ($request->all ());
        return $this->response->created ();
    }

    /**
     * 详情
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show (Slide $slide)
    {
        //
        return $this->response->item ($slide,new Slide());
    }

    /**
     * 更新
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (SlideTransformer $request, Slide $slide)
    {
        //
       // $max_seq = Slide::max ('seq') ?? 0;
        //$max_seq++;
       // $request->offsetSet ('seq',$max_seq);
        Slide::updated($request->all ());
        return $this->response->noContent();
    }

    /**
     * 删除
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy (Slide $slide)
    {
        //
        $slide->delete ();
        return $this->response->noContent ();
    }
    //排序
    public function seq(Request $request,Slide $slide){
        $slide->seq=$request->input('seq',1);
        $slide->save ();
        return $this->response->noContent ();
    }
}
