<?php
namespace app\index\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Request;
use app\index\model\LoginCheck;

class Login extends BaseController
{
    //加载登录模板文件
    public function index()
    {
        return View::fetch('index');
    }

    //处理登录请求,根据角色不同调用不同方法检查用户合法性
    public function login(){
        if(Request::isPost()){
            $data=Request::param();
            $LoginCheck=new LoginCheck();
            if($data['role']=="student"){
                return $LoginCheck->studentCheck($data);
            }
            else if($data['role']=="teacher"){
                return $LoginCheck->teacherCheck($data);
            }else{
                return json([
                    'code'=>'402',
                    'msg'=>'error role'
                ]);
            }
        }
        else{
            //非法提交处理
            return json([
                'code'=>'401',
                'msg'=>'not post'
            ]);
        }

    }

}
