<?php


namespace app\admin\model;



class AdminCommon

{
    //index应用数据返回前台
    public function message($code,$msg='',$data=[]){
        $msg=[
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ];
        echo json_encode($msg);exit;
    }


}