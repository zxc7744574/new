<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

// Route::rule(':version/user/:id','api/:version.User/read');
Route::resource('blogs','index/blog');
//该方法注册了一个名为blogs的资源路由，内部自动注册7个路由规则

return [
    '__pattern__' => [
        'name' => '\w+',
    ]
    
];
