<?php


namespace app\common\model;
use think\facade\Db;


class ButtonAction 
{
    protected $connection = 'mysql';
    protected $table="index_menu";

    //子页面添加
    public function buttonadd($data){
        $smid=$data['smid'];
        $lable=$data['lable'];
        $type=$data['type'];
        $src1=$data['src1'];
        $src2=$data['src2'];
        $sort=$data['sort'];
        $status=$data['status'];
        $res=[
            'lable'=>$lable,
            'sort'=>$sort,
            'type'=>$type,
            'status'=>$status,
            'src'=>"",
            'parentid'=>$smid
        ];
        if($type==1){
            $res['src']=$src1;
        }else{
            $res['src']=$src2;
        }
        $res = Db::connect($this->connection)->table($this->table)
                        ->insert($res);
        if(!$res){
			return $msg=[
                'code'=>'25585',
                'msg'=>'insert fail'
            ];
		}else{
            return $msg=[
                'code'=>'200',
                'msg'=>'insert success'
            ];
        }
    }

    //子页面修改
    public function buttonedit($data){
        $smid=$data['smid'];
        $lable=$data['lable'];
        $type=$data['type'];
        $src1=$data['src1'];
        $src2=$data['src2'];
        $sort=$data['sort'];
        $status=$data['status'];
        $res=[
            'lable'=>$lable,
            'sort'=>$sort,
            'type'=>$type,
            'status'=>$status,
            'src'=>"",
        ];
        if($type==1){
            $res['src']=$src1;
        }else{
            $res['src']=$src2;
        }
        $resdata = Db::connect($this->connection)->table($this->table)
                            ->where('smid',$smid)
                            ->update($res); 
        if(!$resdata){
			return $msg=[
                'code'=>'25585',
                'msg'=>'insert fail or not change ,please try again'
            ];
		}else{
            return $msg=[
                'code'=>'200',
                'msg'=>'insert success'
            ];
        }

    }

    //子页面修改页面
    public function buttoneditview($data){
        $lists = Db::connect($this->connection)->table($this->table)
        ->where('smid',$data)
        ->find();
        return $lists;
    }

    //子页面del
    public function buttondel($data){
        $res = Db::connect($this->connection)->table($this->table)
                            ->where('smid',$data['smid'])
                            ->delete();
        if(!$res){
			return $msg=[
                'code'=>'25585',
                'msg'=>'del fail'
            ];
		}else{
            return $msg=[
                'code'=>'200',
                'msg'=>'del success'
            ];
        }
    }
}