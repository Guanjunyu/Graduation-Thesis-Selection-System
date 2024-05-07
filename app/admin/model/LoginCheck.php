<?php


namespace app\admin\model;
use app\validate\AdminLogin;
use think\Exception;
use think\Facade\Db;


class LoginCheck extends AdminCommon

{

    public $connection="mysql";
    
    // 传入密码加密
    protected function getpwd($password){
        return (md5('gjy love xjl'.sha1($password).'gjy love xjl'));
        // return (md5('gjy'.sha1($password).'gjy'));
    }

        //判断非空
    public function eachNoEmpty($data){
        $flag = true;
        foreach ($data as $value){
            if($value==""){
                $flag=false;
                break;
            }
        }
        return $flag;
    }

        //trylogin写回
    public function writeback($database="mysql",$table,$filed,$data,$changefiled,$changedata){
        $res=Db::connect($database)->table($table)
                            ->where($filed,$data)
                            ->update([$changefiled=>$changedata]);
    }

    public function adminCheck($data){
        if($this->eachNoEmpty($data)){
            $validate=new AdminLogin();
            $checkres=$validate->check($data);
            if($checkres){
                $table=$data['role']."_info";
                //查询数据库
                try{
                    $res=Db::connect($this->connection)->table($table)
                        ->where('adminid',$data['username'])
                        ->findOrFail();
                    if($res['status']==0){
                        $try=$res['trylogin']+1;
                        $realpwd=$this->getpwd($data['password']);
                        if($res['password']==$realpwd){
                            //密码验证通过,尝试登录次数重置
                            $try=0;
                            //将登录次数写回数据库
                            $this->writeback($this->connection,$table,$data['role'].'id',$data['username'],'trylogin',$try);
                            return $msg=[
                                'code'=>'200',
                                'msg'=>'successful',
                                'data'=>[
                                    'username'=>$data['username'],
                                    'role'=>$data['role']
                                    ]
                                ];
                        }
                        else{
                            //密码验证未通过
                            if($try>=3){//连续三次输入错误
                                //登录次数写入数据库,并将状态该为禁用
                                $this->writeback($this->connection,$table,$data['role'].'id',$data['username'],'trylogin',$try);
                                $this->writeback($this->connection,$table,$data['role'].'id',$data['username'],'status',1);
                            }
                            else{
                                //错误次数少于三次,直接写回数据库
                                $this->writeback($this->connection,$table,$data['role'].'id',$data['username'],'trylogin',$try);
                            }
                            return $this->message('901','password error');
                        }
                    }
                    else{//处于非活动
                        return $this->message('901','this id is disbale or password is disable');
                    }
                    
                }catch (Exception $e){
                    return $this->message('900',$e->getMessage());
                }
            }
            else{//字段验证未通过
                return $this->message('408',$validate->getError());
            }
        }
        else{//数据非空验证未通过
            return $this->message('405','some value is empty');
        }
    }

}