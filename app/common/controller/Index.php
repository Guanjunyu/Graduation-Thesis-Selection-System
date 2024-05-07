<?php


namespace app\common\controller;


use think\facade\View;
use think\facade\Cache;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cookie;
use think\facade\Env;
use think\facade\Config;

/* extend userid and role */

class index extends Base
{
    protected $connection='mysql';

    public function index(){

        //权限控制
        //$username=Cookie::get('username');
        // halt($username);
        // 循环遍历形成数组形式的菜单
        /*
        * 权限控制
        * 通过查询对应用户所属的部门
        * 确定用户所有的权限
        * 确定显示的导航功能
        */
         $table=$this->role."_info";
         $filed=$this->role."id";
        //查询用户
         $aUser= Db::connect($this->connection)->table($table)
                             ->where($filed,$this->userId)
                             ->find();
        //查询组
         $table="group_info";
         $group=Db::connect($this->connection)->table($table)
                         ->where('groupid',$aUser['groupid'])
                         ->find();
         if(!empty($group)&&$group['right']){
             $rights=json_decode($group['right']);
         }

        $menu=[];
        if(!empty($rights)){
            if($this->role=="admin"){
                $where=[
                    ['status','=',1],
                    ['smid','in',$rights],
                ];
            }else{
                $where=[
                    ['status','=',1],
                    ['smid','in',$rights],
                    ['show','=',1]
                ];
            }
            $menus = Db::connect('mysql')
                    ->table('index_menu')
                    ->order('type,sort desc')
                    ->where($where)
                    ->select();
            foreach($menus as $menus_v){
                if($menus_v['parentid'] == 0){
                    $menu[$menus_v['smid']] = $menus_v;
                }
                else{
                    $menu[$menus_v['parentid']]['children'][] = $menus_v;
                }
            }
        }

        //print_r($menu);
        View::assign([
            'menu'=>$menu,
            'username'=>$this->userId
        ]);
        return View::fetch("index");
    }

    //主体页面
    public function welcome(){
        return View::fetch("welcome");
    }

    //登录退出
    public function loginout(){
        $role=Cookie::get('role');
        Cookie::delete('username');
        Cookie::delete('role');
        $msg=[
            'code'=>'200',
            'msg'=>'successful',
            "data"=>$role
        ];
        return $msg;
    }

    public function clear(){
        $data=Request::param();
        if($data['flag']==1){
            if(Cache::clear()){
                $msg=[
                    'code'=>200,
                    'msg'=>'缓存清理成功'
                ];
            }else{
                $msg=[
                    'code'=>'23123',
                    'msg'=>"系统繁忙，请稍后再试"
                ];
            }
            return $msg;
        }else{
            $msg=[
                'code'=>200,
                'msg'=>"error"
            ];
            return $msg;
        }
        
    }
}