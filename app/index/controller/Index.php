<?php
namespace app\index\controller;

use app\BaseController;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {
        //return View::fetch('index');
    }
    //这是模板文件调用方法
    // 模板引擎默认定位为view/应用/控制器/模板文件.php(不指定名字默认为操作名)
    // 原生php引入文件位于public目录下
    // 可以使用相对路径,路径的位置起点是public文件夹
    // return require('..\view\index\index\index1.php');直接包含模板文件
    // public function hello($name = 'ThinkPHP6')
    // {
    //     return 'hello,' . $name;
    // }
}
