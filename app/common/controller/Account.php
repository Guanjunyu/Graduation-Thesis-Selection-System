<?php


namespace app\common\controller;


use think\facade\View;
use think\facade\Request;
use think\facade\Cookie;
use think\facade\Env;
use think\facade\Config;
use think\facade\Db;
use app\common\model\AccountAction;

/* extend userid role */
class account extends Base
{
    protected $connection = "mysql";

    //分组信息展示
    public function groupinfo(){
		$AccountAction=new AccountAction();
		$groups=$AccountAction->groupinfo();
		View::assign([
			'group' => $groups
		]);
        return View::fetch("groupinfo");
    }

    //分组添加
    public function groupadd(){
        if(Request::isPost()){
            $data=Request::param();
            $AccountAction=new AccountAction();
            return $AccountAction->groupadd($data);
		}
        else{
            $AccountAction=new AccountAction();
            $menu=$AccountAction->groupaddview();
			View::assign([
				'menus' => $menu
			]);
			return View::fetch();
		}
    }

	public function GetParent(){
		$data=Request::only(['id']);
		$table="index_menu";
        $menus = Db::connect($this->connection)->table($table)
            ->order('smid,sort desc')
            ->where('status','=',1)
			->where('smid',$data['id'])
			->field('parentid')
            ->find();
		return $menus;
	}

	public function GetSon(){
		$data=Request::only(['id']);
		$table="index_menu";
        $menus = Db::connect($this->connection)->table($table)
            ->order('smid,sort desc')
            ->where('status','=',1)
			->where('parentid',$data['id'])
			->field('smid')
            ->select();
		$sonmenu=[];
		foreach($menus as $key =>$value){
			$sonmenu[]=$value['smid'];
		}
		return $sonmenu; 
	}

    //分组修改
    public function groupedit(){
        if(Request::isPost()){
			$data=Request::only(['groupid','groupname','menu','status']);
			if(!isset($data['menu'])){
				$data['menu']="";
			}
			$AccountAction=new AccountAction();
			return $AccountAction->groupedit($data);
		}else{
			$groupid = (int)input('get.groupid');
            $AccountAction=new AccountAction();
            $data=$AccountAction->groupeditview($groupid);
			View::assign([
				'group' => $data['group'],
				'menus' => $data['menu'],
			]);
			return View::fetch("groupedit");
		}
    }

	//分组删除
	public function groupdel(){
		$groupid = (int)input('post.groupid');
		$AccountAction=new  AccountAction();
		return $AccountAction->groupdel($groupid);
	}

    //管理员信息展示
    public function admininfo(){
		$AccountAction=new AccountAction();
		$data=$AccountAction->admininfo();
		View::assign([
			'lists' => $data['lists'],
			'group' => $data['group']
		]);
        return View::fetch("admininfo");
    }

    //添加管理员
    public function adminadd(){
		if(Request::isPost()){
            $data=Request::param();
            $AccountAction=new AccountAction();
			$res=$AccountAction->adminadd($data);
			return $res;
		}else{
			$AccountAction=new AccountAction();
			$group=$AccountAction->adminaddview();
			View::assign([
				'group' => $group
			]);
			return View::fetch();
		}
	}

	//修改管理员
	public function adminedit(){
		if(Request::isPost()){
            $data=Request::param();
			$AccountAction=new AccountAction();
			$res=$AccountAction->adminedit($data);
			return $res;
		}else{
			$adminid = (int)input('get.adminid');
			// 加载管理员
			$AccountAction=new AccountAction();
			$data=$AccountAction->admineditview($adminid);
			View::assign([
				'lists' => $data['lists'],
				'group' => $data['group']
			]);
			return View::fetch();
		}
	}

	//删除管理员
	public function admindel(){
		$adminid = (int)input('post.adminid');
		$AccountAction=new AccountAction();
		return $AccountAction->admindel($adminid);
	}

	public function teacherinfo(){
		$AccountAction=new AccountAction();
		$data=$AccountAction->teacherinfo();
		View::assign([
			'lists' => $data['lists'],
			'group' => $data['group'],
			'college'=> $data['college'],
			'faculty'=> $data['faculty'],
			'major'=> $data['major']
		]);
        return View::fetch("teacherinfo");
	}

	public function teacheradd(){
		if(Request::isPost()){
            $data=Request::param();
            $AccountAction=new AccountAction();
			$res=$AccountAction->teacheradd($data);
			return $res;
		}else{
			$AccountAction=new AccountAction();
			$group=$AccountAction->teacheraddview();
			View::assign([
				'group' => $group
			]);
			return View::fetch();
		}
	}

	public function teacheredit(){
		if(Request::isPost()){
            $data=Request::param();
			$AccountAction=new AccountAction();
			$res=$AccountAction->teacheredit($data);
			return $res;
		}else{
			$teacherid = (int)input('get.teacherid');
			// 加载管理员
			$AccountAction=new AccountAction();
			$data=$AccountAction->teachereditview($teacherid);
			View::assign([
				'lists' => $data['lists'],
				'group' => $data['group']
			]);
			return View::fetch();
		}
	}

	public function teacherdel(){
		$teacherid = (int)input('post.teacherid');
		$AccountAction=new AccountAction();
		return $AccountAction->teacherdel($teacherid);
	}

	public function tempteacherinfo(){
		$AccountAction=new AccountAction();
		$data=$AccountAction->tempteacherinfo();
		View::assign([
			'lists' => $data['lists'],
			'group' => $data['group'],
			'college'=> $data['college'],
			'faculty'=> $data['faculty'],
			'major'=> $data['major']
		]);
        return View::fetch("tempteacherinfo");
	}

	public function tempteacheradd(){
		$teacherid = (int)input('post.teacherid');
		$AccountAction=new AccountAction();
		return $AccountAction->tempteacheradd($teacherid);
	}

	public function tempteachernopass(){
		$teacherid = (int)input('post.teacherid');
		$AccountAction=new AccountAction();
		return $AccountAction->tempteachernopass($teacherid);
		
	}

	public function tempteacherdel(){
		$teacherid = (int)input('post.teacherid');
		$AccountAction=new AccountAction();
		return $AccountAction->tempteacherdel($teacherid);
	}

	public function studentinfo(){
		$AccountAction=new AccountAction();
		$data=$AccountAction->studentinfo();
		View::assign([
			'lists' => $data['lists'],
			'group' => $data['group'],
			'college'=> $data['college'],
			'faculty'=> $data['faculty'],
			'major'=> $data['major'],
			'page'=>$data['page']
		]);
        return View::fetch("studentinfo");
	}

	public function studentadd(){
		if(Request::isPost()){
            $data=Request::param();
            $AccountAction=new AccountAction();
			$res=$AccountAction->studentadd($data);
			return $res;
		}else{
			$AccountAction=new AccountAction();
			$group=$AccountAction->studentaddview();
			View::assign([
				'group' => $group
			]);
			return View::fetch();
		}
	}

	//学生删除,还需要解除与所选课题 bug
	public function studentdel(){
		$studentid = (int)input('post.studentid');
		$AccountAction=new AccountAction();
		return $AccountAction->studentdel($studentid);
	}

	public function studentedit(){
		if(Request::isPost()){
            $data=Request::param();
			$AccountAction=new AccountAction();
			$res=$AccountAction->studentedit($data);
			return $res;
		}else{
			$studentid = (int)input('get.studentid');
			// 加载管理员
			$AccountAction=new AccountAction();
			$data=$AccountAction->studenteditview($studentid);
			View::assign([
				'lists' => $data['lists'],
				'group' => $data['group']
			]);
			return View::fetch();
		}
	}

	public function tempstudentinfo(){
		$AccountAction=new AccountAction();
		$data=$AccountAction->tempstudentinfo();
		View::assign([
			'lists' => $data['lists'],
			'group' => $data['group'],
			'college'=> $data['college'],
			'faculty'=> $data['faculty'],
			'major'=> $data['major'],
			'page'=>$data['page']
		]);
        return View::fetch("tempstudentinfo");
	}

	public function tempstudentadd(){
		$studentid = (int)input('post.studentid');
		$AccountAction=new AccountAction();
		return $AccountAction->tempstudentadd($studentid);
	}

	public function tempstudentnopass(){
		$studentid = (int)input('post.studentid');
		$AccountAction=new AccountAction();
		return $AccountAction->tempstudentnopass($studentid);
	}

	public function tempstudentdel(){
		$studentid = (int)input('post.studentid');
		$AccountAction=new AccountAction();
		return $AccountAction->tempstudentdel($studentid);
	}
}