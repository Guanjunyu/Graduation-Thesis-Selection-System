<?php


namespace app\common\controller;


use think\facade\View;
use think\facade\Request;
use think\facade\Cookie;
use think\facade\Env;
use think\facade\Config;
use think\facade\Db;
use app\common\model\UserSelfAction;

/* extend userid role */
class notice extends Base
{
    protected $connection="mysql";
    protected $table="notice_info";

    public function noticed(){
        return View::fetch("notice",['role'=>$this->role]);
    }

    public function notices(){
        $data=Request::param();
        $role=json_encode($data['role']);
        $create_time=date("Y-m-d H:i:s");
        $nedata=[
            'title'=>$data['title'],
            'content'=>$data['content'],
            'create_time'=>$create_time,
            'senderid'=>$this->userId,
            'rolegroup'=>$role
        ];
        $res=Db::connect($this->connection)->table($this->table)
                    ->insert($nedata);
        if($res){
            $msg=[
                'code'=>"200",
                'msg'=>'insert success'
            ];
        }else{
            $msg=[
                'code'=>'258',
                'msg'=>'insert fail'
            ];
        }
        return $msg;
    }

    //概要
    public function noticesummaryinfo(){
        $lists=Db::connect($this->connection)->table($this->table)
                ->where('senderid',$this->userId)
                ->select();
        return View::fetch("noticesummaryinfo",[
            'lists'=>$lists
        ]);
    }

    //删除公告
    public function noticedel(){
        $id = (int)input('get.id');
        halt($id);
        $res=Db::connect($this->connection)->table($this->table)
            ->where('id',$id)
            ->delete();
        if($res){
            $msg=[
                'code'=>"200",
                'msg'=>'del success'
            ];
        }else{
            $msg=[
                'code'=>'258',
                'msg'=>'del fail'
            ];
        }
        return $msg;
    }

    //全部信息  
    public function noticeinfo(){
        $id = (int)input('get.id');
        $res=Db::connect($this->connection)->table($this->table)
        ->where('id',$id)->find();
        if($res){
            return View::fetch("noticeinfo",['lists'=>$res]);
        }else{
            $this->error("未知错误");
        }
    }

    public function allperson(){
        $param="%".$this->role."%";
        //halt($param);
        $lists=Db::query("SELECT * FROM notice_info WHERE rolegroup LIKE ?", [$param], true);
        return View::fetch('allperson',['lists'=>$lists]);
    }
}