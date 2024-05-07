<?php


namespace app\common\model;

use app\validate\ResetAccount;
use think\facade\Db;
use think\Exception;
use Tools\SendMail;
use Tools\JWTAuth;


class Reset_Account extends CommonCommon
{
    protected $connection = 'mysql';

    public function getandcheck($db,$tb,$data){
        //查询uid 并且返回email和uid的数组
        try {
            $res=Db::connect($db)->table($tb)
                ->where($data['role'].'id',$data['username'])
                ->field(['email',$data['role'].'id'])
                ->findOrFail();
            if($res['email']==$data['email']){
                //验证成功返回结果
                //传递一个角色信息role
                $res['role']=$data['role'];
                $msg=[
                    'code'=>'201',
                    'msg'=>'',
                    'data'=>$res
                ];
                return $msg;
            }else{
                return $this->message('5000','email is not right');
            }
        }catch (Exception $e){
            return $this->message('900',$e->getMessage());
        }

    }


    public function index($data){
        $validate =new ResetAccount();
        $result=$validate->check($data);
        //前端数据验证
        if(!$result){
            return $this->message('401',$validate->getError());
        }
        else{
            if($data['role']=="student"||$data['role']=="teacher"||$data['role']=="admin"){
                $realtable=$data['role']."_info";
                
                $tbdata=$this->getandcheck($this->connection,$realtable,$data);
                if($tbdata['code']=="201"){
                    //形成url以及实现邮件发送
                    //实例化Token类,生成令牌
                    $JWTAuth=new JWTAuth();
                    //$tbdata['data']保存由roleid,email,role信息
                    $Token=$JWTAuth->EnToken($tbdata['data']['email'],$tbdata['data']);
                    //实例化Email类,发送链接
                    $SendMail=new SendMail();
                    $flag=$SendMail->sendemail($tbdata['data']['email'],$Token);
                    return $flag;
                }else{
                    return $tbdata;
                }
            }else{
                return $this->message('402','role is error');
            }
        }
    }

    public function next($token){
        //halt($token['token']);
        if(!empty($token['token'])){
            $JWTAuth=new JWTAuth();
            $res=$JWTAuth->DeToken($token['token']);
            /*
            * ^ array:2 [
            *    "data" => {
            *        "email": "2841597969@qq.com"
            *        "studentid": "111111111111"
            *        "role": "student"
            *        }
            *    "code" => "200"
            *    "msg" => ""
            *    ]
            */
            //halt($res);
            //验证通过,直接重置密码
            if($res['code']=="200"){
                //获得角色
                $urole=$res['data']->role;
                //拼接形成uid索引
                $uidindex=$urole.'id';
                //获得uid
                $uid=$res['data']->$uidindex;
                //获得email
                $uemail=$res['data']->email;
                //halt($uid);
                $repwd=$this->RoleChoose($urole,$uid);
                //halt($repwd);
                //halt($where);
                try{
                    $table=$urole."_info";
                    //halt($table);
                    //return 受影响的行数,应该为1,其他为0
                    $flag=Db::connect($this->connection)->table($table)
                                ->where("email",$uemail)
                                ->where($uidindex,$uid)
                                //返回当前sql语句
                                //->fetchSql(true)
                                ->update(['password'=>$repwd]);
                    if($flag==1){
                        return [
                            'code'=>'200',
                            'msg'=>'success'
                        ];
                    }else{
                        return
                            [
                                'code'=>'9003',
                                'msg'=>'sorry not find user or email OR password is not changed'
                            ];
                    }
                }catch (Exception $e){
                    return [
                        'code'=>'900001',
                        'msg'=>$e->getMessage()
                    ];
                }
            }
            else{
                return $res;
            }
        }else{
            return [
                'code'=>'9004',
                'msg'=>'token is empty'
            ];
        }
    }
}