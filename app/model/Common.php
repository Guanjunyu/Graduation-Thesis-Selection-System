<?php


namespace app\model;


use think\Model;

// header('Content-Type:application/json; charset=utf-8');

class Common extends Model //公共调用类
{

    //结果信息返回前端
    public function message($code,$msg='',$data=[]){
        $msg=[
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ];
        echo json_encode($msg);exit;
    }
}