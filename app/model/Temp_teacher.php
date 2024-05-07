<?php


namespace app\model;


use app\validate\TempTeacher;
use think\Model;

class Temp_teacher extends Common
{
    protected $connection = 'mysql';
    protected $table ="temp_teacher";

    public function setPasswordAttr($value){
        return md5('xjl'.sha1($value).'xjl');
    }

    public function checkinputdata($data)
    {
        $validate = new TempTeacher();
        if (!$validate->check($data)) {
            return $this->message('401', $validate->getError());
        } else {
            $newdata = [
                'teacherid' => $data['userid'],
                'teachername' => $data['name'],
                'sex' => $data['sex'],
                'email' => $data['email'],
                'password' => $data['password2'],
                'role' => $data['role'],
                'collegecode'=>$data['college'],
                'facultycode'=>$data['faculty'],
                'majorcode'=>$data['major'],
            ];
            //dump($newdata);
            $res = Temp_teacher::create($newdata);
            //dump($res);
            if ($res) {
                return $this->message('200', 'teacher success');
            } else {
                return $this->message('402', 'teacher post success,but not write in the database');
            }

        }
    }


}