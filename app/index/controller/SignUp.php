<?php
namespace app\index\controller;

use app\BaseController;
use app\index\model\SelectAction;
use app\model\Temp_student;
use app\model\Temp_teacher;
use think\app\index\model;
use think\facade\Db;
use think\facade\View;
use think\facade\Request;


class SignUp extends BaseController
{
    
    //加载signup模板文件
    public function index()
    {
        return View::fetch('Login\signup');
    }

    // 学院数据预加载
    public function selectcollege(){
        if(Request::isPost()){
            $college=Request::only(['flag']);//只允许获取flag字段
            // halt($college);
            $college_select=new SelectAction();
            return ($college_select->college($college));
        }else{
            // 非法请求
            return json(['code'=>'503','msg'=>'not post']);
        }
    }
    
    // college触发事件
    public function selectfaculty(){
        if(Request::isPost()) {
            $college_code = Request::only(['college_code']);//只允许获取collegecode字段
            //dump($college['college_code']);
            $faculty_select=new SelectAction();
            return ($faculty_select->faculty($college_code));
        }else{
            return json(['code'=>'503','msg'=>'not post']);
        }
    }

    // faculty触发事件
    public function selectmajor(){
        if(Request::isPost()) {
            $faculty_code = Request::only(['faculty_code']);//只允许获取facultycode字段
            //dump($college['college_code']);
            $major_select=new SelectAction();
            return ($major_select->major($faculty_code));
        }else{
            return json(['code'=>'503','msg'=>'not post']);
        }
    }

     //major触发事件
     public function selectclass(){
         if(Request::isPost()){
             $major_code=Request::only(['major_code']);
             $class_select=new SelectAction();
             return ($class_select->class($major_code));
         }
         else{
            //  非法操作
            return json(['code'=>'503','msg'=>'not post']);
         }
    }

     //处理注册请求
    public function signup(){
        if(Request::isPost()){
            $data=Request::param();
            $studentData=$data;
            $teacherData=$data;
            if($data["role"]=="student"){
                //dump(Request::param());
                $res=(new Temp_student())->checkinputdata($studentData);
                return $res;
            }
            else if($data['role']=="teacher"){
                //dump(Request::param());
                $res=(new Temp_teacher())->checkinputdata($teacherData);
                return $res;
            }else{
                return json_encode([ //非法角色提交
                    'code'=>'500',
                    'msg'=>'no student or teacher'
                ]);
            }
        }
        else{
            return json_encode([ //非法提交方式处理
                'code'=>'501',
                'msg'=>'method is error'
            ]);
        }
    }

}