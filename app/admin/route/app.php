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
use think\facade\Route;

// 系统路由测试用例
// Route::get('think', function () {
//     return 'hello,ThinkPHP6!';
// });

// Route::get('hello/:name', 'index/hello');

//自定义路由规则
//Route::rule('rule','routeaddress')

//在admin应用下可以使用以下规则
Route::rule('Login.php','Login/index');
// Route::rule('Login','Login/index');




