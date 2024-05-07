<?php


namespace app\common\controller;


use think\facade\View;
use think\facade\Request;
use think\facade\Cookie;
use think\facade\Env;
use think\facade\Config;
use think\facade\Db;
use app\common\model\MenuAction;
use app\common\model\ButtonAction;

/* extend userid role */
class navigation extends Base
{
    protected $connection = "mysql";
    protected $table="index_menu";

    //加载导航菜单
    public function menuinfo(){

        $MenuAction=new MenuAction();
        $lists=$MenuAction->menuinfo();
		View::assign([
			'lists' => $lists
		]);
        return View::fetch('menuinfo');
    }

    //加载menu添加页以及处理添加请求
    public function menuadd(){
        if(Request::isPost()){
            //处理请求
            $data=Request::only(['lable','sort','status','type','src1','src2']);
            if(empty($data['lable'])||empty($data['sort'])||empty($data['status'])){
                return $msg=[
                    'code'=>'2098',
                    'msg'=>'some value is empty'
                ];
            }else{
                //导航添加操作
                $MenuAction=new MenuAction();
                return $MenuAction->menuadd($data);
            }
        }else{
            //加载页面
            return View::fetch("menuadd");
        }
    }

    //加载menu修改页以及处理修改请求 bug 这里没有对禁用进行合适的操作
    public function menuedit(){
        if(Request::isPost()){
            //处理请求
            $data=Request::only(['smid','lable','sort','status']);
            if(empty($data['smid'])||empty($data['lable'])||empty($data['sort'])){
                return $msg=[
                    'code'=>'2098',
                    'msg'=>'some value is empty'
                ];
            }else{
                //导航修改操作
                $MenuAction=new MenuAction();
                return $MenuAction->menuedit($data);
            }
        }else{
            //加载页面
            $smid=Request::get('smid');
            $MenuAction=new MenuAction();
            $lists=$MenuAction->menueditview($smid);
            View::assign([
				'lists' => $lists
			]);
            return View::fetch("menuedit");
        }
    }

    //导航删除 bug只是删除父节点,没有删除子节点
    public function menudel(){
        if(Request::isPost()){
            $data=Request::only(['smid']);
            if(!empty($data['smid'])){
                $MenuAction=new MenuAction();
                return $MenuAction->menuedel($data);
            }else{
                return $msg=[
                    'code'=>'891',
                    'msg'=>"some value is empty"
                ];
            }
        }
        else{
            return $msg=[
                'code'=>'890',
                'msg'=>"not post"
            ];
        }
    }

    public function nextmenu(){
        if(Request::isGet()){
            $data=Request::only(['smid']);
            $MenuAction=new MenuAction();
            $res=$MenuAction->nextmenu($data['smid']);
            return $res;
        }else{
            return $msg=[
                'code'=>'309',
                'msg'=>'error post'
            ];
        }
    }


    //下级子菜单显示
    public function buttoninfo(){
        if(Request::isGet()){
            $data=Request::only(['smid']);
            if(!empty($data['smid'])){
                $MenuAction=new MenuAction();
                $res=$MenuAction->buttoninfo($data);
                if($res['code']=="200"){
                    View::assign([
                        'lists' => $res['data'],
                        'smid'  => $data['smid']
                    ]);
                    return View::fetch("buttoninfo");
                }else{
                    $this->error("没有下级菜单");
                }
            
            }else{
                return $msg=[
                    'code'=>'891',
                    'msg'=>"some value is empty"
                ];
            }
        }
        else{
            return $msg=[
                'code'=>'890',
                'msg'=>"not get"
            ];
        }
    }

        //子菜单添加
    public function menubuttonadd(){
        if(Request::isPost()){
            //响应处理
            $data=Request::param();
            $ButtonAction=new ButtonAction();
            $res=$ButtonAction->buttonadd($data);
            return $res;
        }else{
            //页面加载
            $data=Request::only(['smid']);
            $smid=$data['smid'];
            View::assign([
				'smid'  => $smid
			]);
            return View::fetch("menubuttonadd");
        }
    }

    //子菜单添加
    public function buttonadd(){
        if(Request::isPost()){
            //响应处理
            $data=Request::param();
            $ButtonAction=new ButtonAction();
            $res=$ButtonAction->buttonadd($data);
            return $res;
        }else{
            //页面加载
            $data=Request::only(['smid']);
            $smid=$data['smid'];
            View::assign([
				'smid'  => $smid
			]);
            return View::fetch("buttonadd");
        }
    }

    //子菜单item修改
    public function buttonedit(){
        if(Request::isPost()){
            //响应处理
            $data=Request::param();
            // halt($data);
            $ButtonAction=new ButtonAction();
            $res=$ButtonAction->buttonedit($data);
            return $res;
        }else{
            //页面加载
            $data=Request::only(['smid']);
            $smid=$data['smid'];
            $ButtonAction=new ButtonAction();
            $lists=$ButtonAction->buttoneditview($smid);
            View::assign([
				'lists'=>$lists
			]);
            return View::fetch("buttonedit");
        }


    }

    //子菜单item删除
    public function buttondel(){
        $data=Request::param();
        $ButtonAction=new ButtonAction();
        $res=$ButtonAction->buttondel($data);
        return $res;
    }

}