<?php


namespace app\common\model;


class CommonCommon
{
    //Common应用数据返回前台
    public function message($code,$msg='',$data=[]){
        $msg=[
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ];
        echo json_encode($msg);exit;
    }

    protected function StudentPasswordEncode($uid){
        return md5('gjy'.sha1($uid).'gjy');
    }

    protected function TeacherPasswordEncode($uid){
        return md5('xjl'.sha1($uid).'xjl');
    }

    protected function AdminPasswordEncode($uid){
        return md5('gjy'.sha1($uid).'gjy');
    }

    protected function RoleChoose($role,$uid){
        if($role=="student"){
            $pwd=$this->StudentPasswordEncode($uid);
        }
        if ($role=="teacher"){
            $pwd=$this->TeacherPasswordEncode($uid);
        }
        if($role=="admin"){
            $pwd=$this->AdminPasswordEncode($uid);
        }
        return $pwd;
    }
}