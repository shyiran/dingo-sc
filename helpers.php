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
