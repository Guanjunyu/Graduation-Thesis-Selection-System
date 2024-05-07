<?php
namespace app\admin\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Request;
use app\admin\model\LoginCheck;
use think\facade\Cookie;

class Login extends BaseController
{
    public function index()
    {
        return View::fetch('login');
    }

    public function signin(){
        if(Request::isPost()){
            $data=Request::param();
            $LoginCheck=new LoginCheck();
            //halt($data);
            if($data['role']=="admin"){
                $res=$LoginCheck->admincheck($data);
                if($res['code']==200){
                    if(!empty($data['rememberMe'])){
                        // Cookie::set('name', 'value', 3600);
                        Cookie::set('username',$res['data']['username'],60*60*24);
                        Cookie::set('role',$res['data']['role'],60*60*24);
                    }else{
                        Cookie::set('username',$res['data']['username']);
                        Cookie::set('role',$res['data']['role']);
                    }
                    return $res;
                }else{
                    return $res;
                }
            }
            else{
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
