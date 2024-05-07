<?php


namespace app\index\model;
use app\validate\IndexLogin;
use think\Exception;
use think\Facade\Db;


class LoginCheck extends IndexCommon
{
    
    protected $connection="mysql";
    
    // 传入密码加密
    protected function getpwd($role,$password){
        if($role=='student'){
            $res=md5('gjy'.sha1($password).'gjy');
        }else if ($role=='teacher'){
            $res=md5('xjl'.sha1($password).'xjl');
        }else{
            $res=$password;
        }
        return $res;
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

    //学生合法性检查
    public function studentCheck($data){
        
        if($this->eachNoEmpty($data)){//数据非空
            $validate=new IndexLogin();//使用验证器验证各个字段
            $checkres=$validate->check($data);
            if($checkres){//字段验证通过,数据库查询验证
                $table=$data['role']."_info";//拼接形成表
                //halt($table);
                try{
                    // select studentid,password from student_info where studentid = $username
                    //查询返回的是一个数组
                    $res=Db::connect($this->connection)->table($table)
                        ->where('studentid',$data['username'])
                        ->findOrFail();
                    if($res['status']==0){//处于活动
                        //dump(gettype($res['trylogin']));
                        //一旦登录就是数据库中的记录增加,先不写入数据库
                        $try=$res['trylogin']+1;
                        $realpwd=$this->getpwd($data['role'],$data['password']);
                        if($res['password']==$realpwd){
                            //密码验证通过,尝试登录次数重置
                            $try=0;
                            //将登录次数写回数据库
                            $this->writeback($this->connection,$table,$data['role'].'id',$data['username'],'trylogin',$try);
                            return $this->message(
                                '200',
                                'successful',
                                [
                                    'username'=>$data['username'],
                                    'role'=>$data['role']
                                ]
                            );
                        }
                        else{
                            //密码验证未通过
                            //连续三次输入错误
                            if($try>=3){
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
                    }else{//处于非活动
                        return $this->message('901','this id is disbale');
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

    //教师合法性检查
    public function teacherCheck($data){
        if($this->eachNoEmpty($data)){//数据非空
            $validate=new IndexLogin();//使用验证器验证各个字段
            $checkres=$validate->check($data);
            if($checkres){//字段验证通过,数据库查询验证
                $table=$data['role']."_info";//拼接形成表
                //halt($table);
                try{
                    // select studentid,password from student_info where studentid = $username
                    //查询返回的是一个数组
                    $res=Db::connect($this->connection)->table($table)
                        ->where('teacherid',$data['username'])
                        ->findOrFail();
                    if($res['status']==0){//处于活动
                        //dump(gettype($res['trylogin']));
                        $try=$res['trylogin']+1;//尝试登录次数+1
                        $realpwd=$this->getpwd($data['role'],$data['password']);
                        if($res['password']==$realpwd){
                            //密码验证通过,尝试登录次数重置
                            $try=0;
                            //将登录次数写回数据库
                            $this->writeback($this->connection,$table,$data['role'].'id',$data['username'],'trylogin',$try);
                            return $this->message(
                                '200',
                                'successful',
                                [
                                'username'=>$data['username'],
                                'role'=>$data['role']
                                ]
                            );
                        }else{
                            //密码验证未通过
                            if($try>3){//连续三次输入错误
                                $this->writeback($this->connection,$table,$data['role'].'id',$data['username'],'trylogin',$try);
                                $this->writeback($this->connection,$table,$data['role'].'id',$data['username'],'status',1);
                                //登录次数写入数据库,并将状态该为禁用
                            }else{
                                $this->writeback($this->connection,$table,$data['role'].'id',$data['username'],'trylogin',$try);
                                //登录次数写回数据库
                            }
                            return $this->message('901','password error');
                        }
                    }else{//处于非活动
                        return $this->message('901','this id is disbale');
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