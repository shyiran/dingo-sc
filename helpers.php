<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/12 10:24
 */

use App\Models\Category;

//获取所有分类
if (!function_exists ('category_tree')) {
    function category_tree ($status = false)
    {
        $categories = Category::select ([ 'id', 'pid', 'name', 'level', 'status' ])
            ->when ($status !== false, function ($query) use ($status) {
                $query->where ('status', $status);
            })
            ->where ('pid', 0)
            ->with ([
                'children' => function ($query) use ($status) {
                    $query->select ([ 'id', 'pid', 'name', 'level', 'status' ])->when ($status !== false, function ($query) use ($status) {
                        $query->where ('status', $status);
                    });
                },
                'children.children' => function ($query) use ($status) {
                    $query->select ([ 'pid', 'name', 'level', 'status' ])->when ($status !== false, function ($query) use ($status) {
                        $query->where ('status', $status);
                    });
                }
            ])
            ->get ();
        return $categories;
    }
}
/*
 * 缓存函数，所有启用的分类
 */
if (!function_exists ('cache_category')) {
    function cache_category ()
    {
        return cache ()->rememberForever ('cache_category', function () {
            return category_tree (1);
        });

    }
}
/*
 * 缓存函数，所有的分类
 */
if (!function_exists ('cache_category_all')) {
    function cache_category_all ()
    {
        return  cache ()->rememberForever ('cache_category', function () {
            return category_tree ();
        });
    }
}

/*
 * 缓存函数，清空分类缓存
 */
if (!function_exists ('clear_cache_category')) {
    function clear_cache_category ()
    {
        cache ()->forget ('cache_category');
        cache ()->forget ('cache_category_all');
    }
}
//HTTP请求（支持HTTP/HTTPS，支持GET/POST）
function http_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
function geturl($url,$data=''){
    $headerArray =array("Content-type:application/json;","Accept:application/json");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url.$data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output,true);
    return $output;
}


function posturl($url,$data){
    $data  = json_encode($data);
    $headerArray =array("Content-type:application/json;charset='utf-8'","Accept:application/json");
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return json_decode($output,true);
}


function puturl($url,$data){
    $data = json_encode($data);
    $ch = curl_init(); //初始化CURL句柄
    curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
    curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT"); //设置请求方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output,true);
}

function delurl($url,$data){
    $data  = json_encode($data);
    $ch = curl_init();
    curl_setopt ($ch,CURLOPT_URL,$put_url);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output,true);
}

function patchurl($url,$data){
    $data  = json_encode($data);
    $ch = curl_init();
    curl_setopt ($ch,CURLOPT_URL,$url);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);     //20170611修改接口，用/id的方式传递，直接写在url中了
    $output = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output);
    return $output;
}
