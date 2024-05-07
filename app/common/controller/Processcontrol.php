<?php


namespace app\common\controller;


use think\facade\View;
use think\facade\Request;
use think\facade\Cookie;
use think\facade\Env;
use think\facade\Config;
use think\facade\Db;

/* extend userid role */
class processcontrol extends Base
{
    public function control(){
        $select=Db::connect("mysql")->table("index_menu")->where('smid',14)->field('show')->find();
        $sign=Db::connect("mysql")->table("index_menu")->where('smid',16)->field('show')->find();
        return View::fetch('control',[
            'flag1'=>$select['show'],
            'flag2'=>$sign['show']
        ]);
    }

    public function topicselection(){
        $flag=(int)trim(input("get.topicselection"));
        if($flag==1||$flag==0){
            $res=Db::connect("mysql")->table("index_menu")->where('smid',16)->update(['show' => $flag]);
            return $msg=[
                'code'=>'200',
            ];
        }
        else{
            return $msg=['code'=>'201'];
        }
    }


    public function Signtopic(){
        $flag=(int)trim(input("get.Signtopic"));
        if($flag==1||$flag==0){
            $res=Db::connect("mysql")->table("index_menu")->where('smid',14)->update(['show' => $flag]);
            return $msg=[
                'code'=>'200',
            ];
        }
        else{
            return $msg=['code'=>'201'];
        }
    }

}