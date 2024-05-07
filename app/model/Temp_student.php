<?php


namespace app\model;

use app\validate\TempStudent;
use think\Model;

class Temp_student extends Common
{
    //设置操作的数据库表,默认跟类名相同
    protected $connection = 'mysql';
    protected $table ="temp_student";

    //    密码自动加密存储函数,修改器格式:set+字段+Attr(值)
    public function setPasswordAttr($value){
        return md5('gjy'.sha1($value).'gjy');
    }

    //数据验证并写入临时表中
    public function checkinputdata($data){
        $validate =new TempStudent();//实例化验证器
        $result=$validate->check($data);//检查表单提交的原始数据
        //dump($result);
        if(!$result){
            return $this->message('401',$validate->getError());
        }
        else{
            // 验证通过后对字段进行映射并写入临时表中
            $newdata=[
                'studentid'=>$data['userid'],
                'studentname'=>$data['name'],
                'sex'=>$data['sex'],
                'email'=>$data['email'],
                'role'=>$data['role'],
                'password'=>$data['password2'],
                'collegecode'=>$data['college'],
                'facultycode'=>$data['faculty'],
                'majorcode'=>$data['major'],
                'class'=>$data['class']
                
            ];
            //dump($newdata);
            $res=Temp_student::create($newdata);
            //dump($res);
            if($res){
                return $this->message('200','student success');
            }else{
                return $this->message('402','student post success,but not write in the database');
            }
        }

    }

}