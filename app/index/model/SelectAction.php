<?php


namespace app\index\model;

use think\facade\Db;
use app\model\Common ;

class SelectAction extends indexCommon
{
    //学院数据查询
    public function college($college){
        //halt($college);
        if($college['flag']==1){
            $college_list = Db::connect('mysql')->table('college_info')->select();
            return $this->message('200','',$college_list);
        }else{
            return $this->message('502','no post faculty code or faculty code is no right');
        }
    }

    //系信息查询
    public function faculty($college_code){
        if($college_code['college_code']!=""){
            $faculty_list=Db::connect('mysql')
            ->table('faculty_info')
            ->where('collegecode',$college_code['college_code'])
            ->select();
            return $this->message('200','',$faculty_list);
        }else{
            return $this->message('502','no post faculty code or faculty code is no right');
        }
    }

    //专业信息查询
    public function major($faculty_code){
        if($faculty_code['faculty_code']!=""){
            $major_list=Db::connect('mysql')
            ->table('major_info')
            ->where('facultycode',$faculty_code['faculty_code'])
            ->select();
            return $this->message('200','',$major_list);
        }else{
            return $this->message('502','','no post faculty code or faculty code is no right');
        }
    }

    //班级信息查询
    public function class($major_code){
        if($major_code!=""){
            $class_list=Db::connect('mysql')
            ->table('class_info')
            ->where('majorcode',$major_code['major_code'])
            ->select();
            return $this->message('200','',$class_list);
        }
        else{
            return $this->message('502','no post faculty code or faculty code is no right');
        }
    }
}