<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class DepartmentController extends BaseController
{
    protected $authenticationToken;

    public function __construct ()
    {
        $this->authenticationToken = "4bU8bXQsq2S1Ac-VrSi2OLY0rri6f_p7WD-cwOC21ptMFFU4BPCecwmpPCk7ywdOsGB0OEpxWy7Z0piDZ0gFUoE-QRuKE-uyIvW2ly3LpWgLN9Vs0vUiBcug8VHKlrS3NMeVWF3ObPOBBGATTJk8onsdEdHUbAFx2B2oVJ0SlEkrzb6HNPJNb5YUqbzrCSf_1DxSVZOviFgHUbGSZwya_A";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        //
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
    public function show ($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($id)
    {
        //
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

    //创建部门
    public function createDepartment ()
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/department/create?access_token=' . $this->authenticationToken;
        $data = array (
            "name" => "广州研发中心",
            "name_en" => "RDGZ",
            "parentid" => 1,
            "order" => 1,
            "id" => 2
        );
        return posturl ($url, $data);
    }
    //更新部门
    public function updateDepartment(){
        $url='https://qyapi.weixin.qq.com/cgi-bin/department/update?access_token='.$this->authenticationToken;
        $data = array (
            "name" => "广州研发中心",
            "name_en" => "RDGZ",
            "parentid" => 1,
            "order" => 1,
            "id" => 2
        );
        return posturl ($url, $data);
    }
    //删除部门
    public function delDepartment(){
        $d_id='1';
        $url='https://qyapi.weixin.qq.com/cgi-bin/department/delete?access_token='.$this->authenticationToken.'&id='.$d_id;
        return posturl ($url);

    }
    //获取部门列表
    public function getDepartmentList ()
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token=' . $this->authenticationToken;
        return geturl ($url);
    }
}
