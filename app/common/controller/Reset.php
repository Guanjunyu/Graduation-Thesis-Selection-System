<?php


namespace app\common\controller;


use app\BaseController;
use think\facade\View;
use think\facade\Request;
use app\Common\model\Reset_Account;

class reset extends BaseController
{
    public function index(){
        return View::fetch("formstep");
    }

    public function datacheck(){
        //post提交方式
        $data=Request::only(['username','email','role','captcha']);
        $Reset_Account= new Reset_Account();
        return ($Reset_Account->index($data));
    }

    //email检查Token,检查成功后,加载视图
    public function emailcheck(){
        //get提交方式
        $Token=Request::only(['token']);
        $Reset_Account= new Reset_Account();
        $res=$Reset_Account->next($Token);
        //判断数据集中code代码并加载对应的视图
        $msg=[
            'msg'=>$res['msg']
        ];
        if($res['code']=="200"){
            return View::fetch("resetsuccess",['msg'=>$msg]);
        }else{
            return View::fetch("resetfail",['msg'=>$msg]);
        }
    }
}