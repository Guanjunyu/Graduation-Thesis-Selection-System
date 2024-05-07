<?php


namespace app\common\model;
use think\facade\Db;


class UserSelfAction
{
    protected $connection="mysql";

    protected function DePassword($role,$password){
        if($role=="student"){
            $password=(md5('gjy'.sha1($password).'gjy'));
        }
        if($role=="teacher"){
            $password=(md5('xjl'.sha1($password).'xjl'));
        }
        if($role=="admin"){
            // (md5('gjy love xjl'.sha1($password).'gjy love xjl'));
            $password=(md5('gjy'.sha1($password).'gjy'));
        }
        return $password;
    }

    public function userinfoview($role,$userid){
        $table=$role."_info";
        $field=$role."id";
        $aUser=Db::connect($this->connection)->table($table)->where($field,$userid)
            ->find();
        $groupid=$aUser['groupid'];
        if(array_key_exists('majorcode', $aUser)){
            $majorcode=$aUser['majorcode'];
            $table="major_info";
            $name=Db::connect($this->connection)->table($table)->where("majorcode",$majorcode)
                    ->field(['majorname'])
                    ->find();
            $aUser['majorname']=$name['majorname'];
        }else{
            $aUser['majorname']="";
        }
        $table="group_info";
        $groupname=Db::connect($this->connection)->table($table)->where('groupid',$groupid)
                ->field(['groupname'])
                ->find();
        $aUser['account']=$aUser[$field];
        $aUser['groupname']=$groupname['groupname'];
        return $aUser;
    }

    public function userinfoedit($role,$userid,$data){
        $name=$data['name'];
        $sex=$data['sex'];
        $email=$data['email'];
        $old_pwd=$data['old_pwd'];
        $new_pwd=$data['new_pwd'];

        $table=$role."_info";
        $field=$role."id";
        //halt(!empty($old_pwd)&&!empty($new_pwd));
        if(!empty($old_pwd)&&!empty($new_pwd)){
            $User=Db::connect($this->connection)->table($table)
                        ->where($field,$userid)->find();
            if($this->DePassword($role,$old_pwd)==$User['password']){
                $password=$this->DePassword($role,$new_pwd);
                $newdata=[
                    'name'=>$name,
                    'sex'=>$sex,
                    'email'=>$email,
                    'password'=>$password
                ];
                halt($newdata);
                $res=Db::connect($this->connection)->table($table)->where($field,$userid)
                    ->update($newdata);
                if($res){
                    $msg=[
                        'code'=>'200',
                        'msg'=>'update successful'
                    ];
                }else{
                    $msg=[
                        'code'=>'201',
                        'msg'=>'update fail'
                    ];
                }
                return $msg;
            }
            else{
                $msg=[
                    'code'=>'205',
                    'msg'=>'pwd no right'
                ];
                return $msg;
            }
        }
        else{
            $res=Db::connect($this->connection)->table($table)
            ->where($field,$userid)->update(['name'=>$name,'sex'=>$sex,'email'=>$email]);
            if($res){
                $msg=[
                    'code'=>'200',
                    'msg'=>'update successful'
                ];
            }else{
                $msg=[
                    'code'=>'201',
                    'msg'=>'update fail 201'
                ];
            }
            return $msg;
        }
    }
}