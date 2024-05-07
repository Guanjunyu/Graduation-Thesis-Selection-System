<?php


namespace app\common\controller;


use think\facade\View;
use think\facade\Request;
use think\facade\Cookie;
use think\facade\Env;
use think\facade\Config;
use think\facade\Db;
use app\common\model\ProjectAction;

/* extend userid role */
class project extends Base
{
    public function collectproject(){
        if(Request::isPost()){
            $data=Request::param();
            $ProjectAction=new ProjectAction();
			$res=$ProjectAction->collectproject($data);
			return $res;
		}else{
            if($this->role=="teacher"){
                $ProjectAction=new ProjectAction();
                $data=$ProjectAction->collectprojectview($this->role,$this->userId);
                View::assign([
                    'user'=>$data['username'],
                    'userid'=>$this->userId,
                    'major'=>$data['major']
                ]);
                return View::fetch("collectproject");
            }else if($this->role=="admin"){
                //加载测试模板
                return View::fetch("collectprojecttempview");
            }
            else
            {
                $this->error("对不起此功能暂时只提供给教师使用");
            }
        }
    }

    public function auditproject(){
        if($this->role=='teacher'||$this->role=='admin'){
            $ProjectAction=new ProjectAction();
            $data=$ProjectAction->auditprojectinfo();
            View::assign([
                'lists' => $data['lists'],
                'name' => $data['name']
            ]);
            return View::fetch("auditproject");
        }else{
            $this->error("对不起您无权访问该功能");
        }
    }

    public function auditprojectadd(){
        $id = (int)input('post.Id');
		$ProjectAction=new ProjectAction();
		return $ProjectAction->auditprojectadd($id);
    }

    public function auditprojectdel(){
        $id = (int)input('post.Id');
		$ProjectAction=new ProjectAction();
		return $ProjectAction->auditprojectdel($id);
    }

    public function auditprojectteacher(){
        if($this->role=="teacher"){
            $ProjectAction=new ProjectAction();
            $data=$ProjectAction->auditprojectteacherinfo($this->userId);
            View::assign([
                'lists' => $data['lists'],
            ]);
            return View::fetch("auditprojectteacher");
        }else{
            $this->error("该功能只提供给教师使用");
        }

    }

    public function chooseproject(){
        if($this->role=="student"){
            $ProjectAction=new ProjectAction();
            $data=$ProjectAction->chooseprojectinfo($this->userId);
            // halt($data['checked']);
            View::assign([
                'lists' => $data['lists'],
                'name' => $data['name'],
                'checked'=>$data['checked']
            ]);
            return View::fetch("chooseproject");
        }else{
            $this->error('此功能只开放给学生用于课题选择');
        }
    }

    public function ensureproject(){
        $projectid = (int)input('post.projectid');
        $ProjectAction=new ProjectAction();
        $data=$ProjectAction->ensureproject($projectid,$this->userId);
        return $data;
    }

    public function showproject(){
        $projectid = (int)input('get.projectid');
        $ProjectAction=new ProjectAction();
        $data=$ProjectAction->showprojectdata($projectid);
        return View::fetch("showproject",['data'=>$data]);
    }

    public function showtempproject(){
        $Id = (int)input('get.Id');
        $ProjectAction=new ProjectAction();
        $data=$ProjectAction->showtempprojectdata($Id);
        return View::fetch("showtempproject",['data'=>$data]);
    }

    public function showsprojectstudent(){
        if(Request::isPost()){
            $data=Request::param();
            $studentid=$data['studentid'];
            $projectid=$data['projectid'];
            $ProjectAction=new ProjectAction();
            $res=$ProjectAction->delproject($studentid,$projectid);
            return $res;
        }else{
            if($this->role=='student'){
                $ProjectAction=new ProjectAction();
                $data=$ProjectAction->showsprojectstudent($this->userId);
                return View::fetch("showprojectstudent",['data'=>$data]);
            }else{
                $this->error("此功能只开放给学生用户查看自己选题情况");
            }

        }
    }

    public function showprojectteacher(){
        if($this->role=="teacher"){
            $ProjectAction=new ProjectAction();
            $data=$ProjectAction->showprojectteacher($this->userId);
            View::assign([
                'lists' => $data['lists'],
                'name'=>$data['name']
            ]);
            return View::fetch("showprojectteacher");
        }else{
            $this->error("该功能是给教师私人查看数据使用");
        }
    }

    public function showallproject(){
        if($this->role=="teacher"){
            $ProjectAction=new ProjectAction();
            $data=$ProjectAction->showallproject($this->userId);
            View::assign([
                'lists' => $data['lists'],
                'name' => $data['name']
            ]);
            return View::fetch("showallproject");
        }else if($this->role=="admin"){
            $this->error("教务办等用户,请到数据统计模板查看");
        }else{
            $this->error("对不起,您不是教师");
        }

    }

    public function statistical(){
        if($this->role=="admin"){
            $ProjectAction=new ProjectAction();
            $data=$ProjectAction->statistical();
            return View::fetch('statistical',['data'=>$data]);
        }
        else{
            $this->error("对不起,你没有权限");
        }

    }

    public function searchdata(){
        $indata = input('get.data');
        $ProjectAction=new ProjectAction();
        $data=$ProjectAction->statisticalsearch($indata);
        return View::fetch('searchdata',['data'=>$data['data']]);
    }
}