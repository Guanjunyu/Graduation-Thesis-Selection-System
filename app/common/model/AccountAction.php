<?php


namespace app\common\model;
use think\facade\Db;
use app\validate\AdminAdd;
use app\validate\AdminEdit;
use app\validate\StudentAdd;
use app\validate\StudentEdit;
use app\validate\TeacherAdd;
use app\validate\TeacherEdit;
use think\Exception;


class AccountAction 
{
    public $connection="mysql";

    private function Depassword($password){
        return (md5('gjy love xjl'.sha1($password).'gjy love xjl'));
        //return (md5('gjy'.sha1($password).'gjy'));
    }

    public function groupinfo(){
        $table="group_info";
		$groups = Db::connect($this->connection)->table($table)->paginate(5,20);
        return $groups;
    }

    public function groupaddview(){
        $table='index_menu';
        $menus = Db::connect($this->connection)->table($table)
            ->order('type,sort desc')
            ->where('status','=',1)
            ->select();

        $menu=[];
        foreach($menus as $menus_v){
            if($menus_v['parentid'] == 0){
                $menu[$menus_v['smid']] = $menus_v;
            }else{
                $menu[$menus_v['parentid']]['children'][] = $menus_v;
            }
        }
        return $menu;
    }

    public function groupadd($data){
        $resdata['groupname']=$data['groupname'];
        $resdata['status']=$data['status'];
        $resdata['right'] = json_encode(array_keys($data['menu']));
        $table="group_info";
        $res = Db::connect($this->connection)->table($table)->insert($resdata);
        if($res){
            $msg=[
                'code'=>'200',
                'msg'=>'insert success'
            ];
        }else{
            $msg=[
                'code'=>'852',
                'msg'=>'insert fail'
            ];
        }
        return $msg;
    }

    public function groupeditview($groupid){
        $table="group_info";
        $group = Db::connect($this->connection)->table($table)
            ->where('groupid',$groupid)
            ->find();
        if($group && $group['right']){
            $group['right'] = json_decode($group['right']);
        }
        $table="index_menu";
        $menus = Db::connect($this->connection)->table($table)
            ->order('smid,sort desc')
            ->where('status','=',1)
            ->select();
        foreach($menus as $menus_v){
            if($menus_v['parentid'] == 0){
                $menu[$menus_v['smid']] = $menus_v;
            }else{
                $menu[$menus_v['parentid']]['children'][] = $menus_v;
            }
        }
        return $data=['group'=>$group,'menu'=>$menu];
    }

    public function groupedit($data){
        $groupid=$data['groupid'];
        $resdata['groupname']=$data['groupname'];
        $resdata['status']=$data['status'];
        $menu=$data['menu'];
        if($menu){
            $resdata['right'] = json_encode(array_keys($menu));
        }else{
            $resdata['right'] = '';
        }
        $table="group_info";
        $res = Db::connect($this->connection)->table($table)
            ->where('groupid',$groupid)
            ->update($resdata);
        if($res){
            $msg=[
                'code'=>'200',
                'msg'=>'update success'
            ];
        }
        else{
            $msg=[
                'code'=>'2852',
                'msg'=>'update fail'
            ];
        }
        return $msg;
    }

    public function groupdel($groupid){
        $table="group_info";
        $res = Db::connect($this->connection)->table($table)
            ->where('groupid',$groupid)
            ->delete();
        if(!$res){
            $msg=[
                'code'=>'1200',
                'msg'=>'del fail'
            ];
        }else{
            $msg=[
                'code'=>'200',
                'msg'=>'del success'
            ];
        }
        return $msg;
    }

    //管理员信息展示
    public function admininfo(){
        $table="admin_info";
        $lists = Db::connect($this->connection)->table($table)->paginate(5,20);
        $table="group_info";
		$group = [];
		$groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $data=['lists'=>$lists,'group'=>$group];
    }

    //管理员添加
    public function adminadd($data){
        $validate=new AdminAdd();
        $checkres=$validate->check($data);
        if($checkres){
            //检查通过,写入数据库
            $table="admin_info";
            $relpassword=$this->Depassword($data['password']);
            $newdata=[
                'adminid'=>$data['adminid'],
                'password'=>$relpassword,
                'name'=>$data['name'],
                'sex'=>$data['sex'],
                'email'=>$data['email'],
                'groupid'=>$data['groupid'],
                'status'=>$data['status'],
            ];
            $res=Db::connect($this->connection)->table($table)
                                ->insert($newdata);
            if(!empty($res)){
                $msg=[
                    'code'=>'200',
                    'msg'=>'insert success'
                ];
            }else{
                $msg=[
                    'code'=>'2665',
                    'msg'=>'insert fail'
                ];
            }
            return $msg;
        }else{
            return ['code'=>"2222","msg"=>"no pass check"];
        }
    }

    //管理员添加展示
    public function adminaddview(){
        $table="group_info";
        $group = [];
        $groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $group;
    }

    //管理修改
    public function adminedit($data){
        $validate=new AdminEdit();
        $checkres=$validate->check($data);
        if($checkres){
            $table="admin_info";
            $adminid=$data['adminid'];
            $newdata=[
                'name'=>$data['name'],
                'email'=>$data['email'],
                'groupid'=>$data['groupid'],
                'sex'=>$data['sex'],
                'status'=>$data['status']
            ];
            $res = Db::connect($this->connection)->table($table)
                        ->where('adminid',$adminid)
                        ->update($newdata);
            if($res){
                $msg=[
                    'code'=>"200",
                    'msg'=>'update success'
                ];
            }else{
                $msg=[
                    'code'=>"1254421",
                    'msg'=>'update fail'
                ];
            }
            return $msg;
        }else{
            return ['code'=>"90000",'msg'=>$validate->getError()];
        }
    }

    //管理修改视图
    public function admineditview($adminid){
        $table="admin_info";
        $lists = Db::connect($this->connection)->table($table)->where('adminid',$adminid)->find();
        $table="group_info";
        $group = [];
        $groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $data=['group'=>$group,'lists'=>$lists];
    }

    //管理员删除
    public function admindel($data){
        $table="admin_info";
		$res = Db::connect($this->connection)->table($table)->where('adminid',$data)->delete();
		if(empty($res)){
			$msg=[
                'code'=>'234',
                '$msg'=>'del fail'
            ];
		}else{
            $msg=[
                'code'=>'200',
                'msg'=>'del success'
            ];
        }
		return $msg;
    }

    public function teacherinfo(){
        $table="teacher_info";
        $lists = Db::connect($this->connection)->table($table)->paginate(5,10);
        // 获取分页显示
        //$page = $lists->render();
        $table="group_info";

        $college=[];
        $collegetb="college_info";
        $colleges=Db::connect($this->connection)->table($collegetb)->select();
        if(!empty($colleges)){
            foreach ($colleges as $key => $value) {
                $college[$value['collegecode']] = $value;
            }
        }

        $faculty=[];
        $facultytb="faculty_info";
        $facultys=Db::connect($this->connection)->table($facultytb)->select();
        if(!empty($facultys)){
            foreach ($facultys as $key => $value) {
                $faculty[$value['facultycode']] = $value;
            }
        }

        $major=[];
        $majortb="major_info";
        $majors=Db::connect($this->connection)->table($majortb)->select();
        if(!empty($majors)){
            foreach ($majors as $key => $value) {
                $major[$value['majorcode']] = $value;
            }
        }

		$group = [];
		$groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $data=[
            'lists'=>$lists,
            'group'=>$group,
            'college'=>$college,
            'faculty'=>$faculty,
            'major'=>$major
        ];
    }

    public function teacheradd($data){
        $validate=new TeacherAdd();
        $checkres=$validate->check($data);
        if($checkres){
            //检查通过,写入数据库
            $table="teacher_info";
            $relpassword=md5('xjl'.sha1($data['password']).'xjl');
            $newdata=[
                'teacherid'=>$data['teacherid'],
                'password'=>$relpassword,
                'name'=>$data['name'],
                'sex'=>$data['sex'],
                'email'=>$data['email'],
                'groupid'=>$data['groupid'],
                'status'=>$data['status'],
            ];
            $res=Db::connect($this->connection)->table($table)
                                ->insert($newdata);
            if(!empty($res)){
                $msg=[
                    'code'=>'200',
                    'msg'=>'insert success'
                ];
            }else{
                $msg=[
                    'code'=>'2665',
                    'msg'=>'insert fail'
                ];
            }
            return $msg;
        }else{
            return ['code'=>"2222","msg"=>"no pass check"];
        }
    }

    public function teacheraddview(){
        $table="group_info";
        $group = [];
        $groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $group;
    }

    public function teachereditview($teacherid){
        $table="teacher_info";
        $lists = Db::connect($this->connection)->table($table)->where('teacherid',$teacherid)->find();
        $table="group_info";
        $group = [];
        $groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $data=['group'=>$group,'lists'=>$lists];
    }

    public function teacheredit($data){
        $validate=new TeacherEdit();
        $checkres=$validate->check($data);
        if($checkres){
            $table="teacher_info";
            $teacherid=$data['teacherid'];
            $newdata=[
                'name'=>$data['name'],
                'email'=>$data['email'],
                'groupid'=>$data['groupid'],
                'sex'=>$data['sex'],
                'status'=>$data['status']
            ];
            $res = Db::connect($this->connection)->table($table)
                        ->where('teacherid',$teacherid)
                        ->update($newdata);
            if($res){
                $msg=[
                    'code'=>"200",
                    'msg'=>'update success'
                ];
            }else{
                $msg=[
                    'code'=>"1254421",
                    'msg'=>'update fail'
                ];
            }
            return $msg;
        }else{
            return ['code'=>"90000",'msg'=>$validate->getError()];
        }
    }

    public function teacherdel($teacherid){
        $table="teacher_info";
		$res = Db::connect($this->connection)->table($table)
                            ->where('teacherid',$teacherid)->delete();
		if(empty($res)){
			$msg=[
                'code'=>'234',
                '$msg'=>'del fail'
            ];
		}else{
            $msg=[
                'code'=>'200',
                'msg'=>'del success'
            ];
        }
		return $msg;
    }

    public function tempteacherinfo(){
        $table="Temp_teacher";
        $lists = Db::connect($this->connection)->table($table)->paginate(5,20);
        $page=$lists->render();

        $college=[];
        $collegetb="college_info";
        $colleges=Db::connect($this->connection)->table($collegetb)->select();
        if(!empty($colleges)){
            foreach ($colleges as $key => $value) {
                $college[$value['collegecode']] = $value;
            }
        }

        $faculty=[];
        $facultytb="faculty_info";
        $facultys=Db::connect($this->connection)->table($facultytb)->select();
        if(!empty($facultys)){
            foreach ($facultys as $key => $value) {
                $faculty[$value['facultycode']] = $value;
            }
        }

        $major=[];
        $majortb="major_info";
        $majors=Db::connect($this->connection)->table($majortb)->select();
        if(!empty($majors)){
            foreach ($majors as $key => $value) {
                $major[$value['majorcode']] = $value;
            }
        }

		$group = [];
        $table="group_info";
		$groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $data=[
            'lists'=>$lists,
            'group'=>$group,
            'college'=>$college,
            'faculty'=>$faculty,
            'major'=>$major,
            'page'=>$page
        ];
    }

    public function tempteacheradd($teacherid){
        $table="teacher_info";
        $test=Db::connect($this->connection)->table($table)
                    ->field("teacherid")
                    ->where("teacherid",$teacherid)
                    ->findOrEmpty();
        if(!empty($test)){
            $table="temp_teacher";
            $res=Db::connect($this->connection)->table($table)
                ->where('teacherid',$teacherid)->delete();
            return [
                'code'=>'852',
                'msg'=>"user is ex"
            ];
        }
        $table="temp_teacher";
        $res=Db::connect($this->connection)->table($table)
                ->where('teacherid',$teacherid)
                ->find();
        $newdata=[
            'teacherid'=>$res['teacherid'],
            'name'=>$res['teachername'],
            'sex'=>$res['sex'],
            'email'=>$res['email'],
            'password'=>$res['password'],
            'collegecode'=>$res['collegecode'],
            'facultycode'=>$res['facultycode'],
            'majorcode'=>$res['majorcode'],
        ];
        $table="teacher_info";
        $result=Db::connect($this->connection)->table($table)->insert($newdata);
        $table="temp_teacher";
        $res=Db::connect($this->connection)->table($table)
            ->where('teacherid',$teacherid)
            ->update(['checked'=>1]);
        return $msg=['code'=>'200','msg'=>'insert success'];
    }

    public function tempteachernopass($teacherid){
        $table="temp_teacher";
		$res = Db::connect($this->connection)->table($table)
                            ->where('teacherid',$teacherid)->update(['checked'=>1]);
		if(empty($res)){
			$msg=[
                'code'=>'234',
                '$msg'=>'update fail'
            ];
		}else{
            $msg=[
                'code'=>'200',
                'msg'=>'update success'
            ];
        }
		return $msg;
    }

    public function tempteacherdel($teacherid){
        $table="temp_teacher";
		$res = Db::connect($this->connection)->table($table)
                            ->where('teacherid',$teacherid)->delete();
		if(empty($res)){
			$msg=[
                'code'=>'234',
                '$msg'=>'del fail'
            ];
		}else{
            $msg=[
                'code'=>'200',
                'msg'=>'del success'
            ];
        }
		return $msg;
    }

    public function studentinfo(){
        $table="student_info";
        $lists = Db::connect($this->connection)->table($table)->paginate(5,20);
        $page = $lists->render();

        $college=[];
        $collegetb="college_info";
        $colleges=Db::connect($this->connection)->table($collegetb)->select();
        if(!empty($colleges)){
            foreach ($colleges as $key => $value) {
                $college[$value['collegecode']] = $value;
            }
        }

        $faculty=[];
        $facultytb="faculty_info";
        $facultys=Db::connect($this->connection)->table($facultytb)->select();
        if(!empty($facultys)){
            foreach ($facultys as $key => $value) {
                $faculty[$value['facultycode']] = $value;
            }
        }

        $major=[];
        $majortb="major_info";
        $majors=Db::connect($this->connection)->table($majortb)->select();
        if(!empty($majors)){
            foreach ($majors as $key => $value) {
                $major[$value['majorcode']] = $value;
            }
        }

        $table="group_info";
		$group = [];
		$groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $data=[
            'lists'=>$lists,
            'group'=>$group,
            'college'=>$college,
            'faculty'=>$faculty,
            'major'=>$major,
            'page'=>$page
        ];
    }

    public function studentadd($data){
        $validate=new StudentAdd();
        $checkres=$validate->check($data);
        if($checkres){
            //检查通过,写入数据库
            $table="student_info";
            $relpassword=md5('gjy'.sha1($data['password']).'gjy');
            $newdata=[
                'studentid'=>$data['studentid'],
                'password'=>$relpassword,
                'name'=>$data['name'],
                'sex'=>$data['sex'],
                'email'=>$data['email'],
                'groupid'=>$data['groupid'],
                'status'=>$data['status'],
            ];
            $res=Db::connect($this->connection)->table($table)
                                ->insert($newdata);
            if(!empty($res)){
                $msg=[
                    'code'=>'200',
                    'msg'=>'insert success'
                ];
            }else{
                $msg=[
                    'code'=>'2665',
                    'msg'=>'insert fail'
                ];
            }
            return $msg;
        }else{
            return ['code'=>"2222","msg"=>"no pass check"];
        }
    }

    public function studentaddview(){
        $table="group_info";
        $group = [];
        $groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $group;
    }


    //学生删除,还需要解除与所选课题
    public function studentdel($studentid){
        $table="student_info";
		$res = Db::connect($this->connection)->table($table)
                            ->where('studentid',$studentid)->delete();
		if(empty($res)){
			$msg=[
                'code'=>'234',
                '$msg'=>'del fail'
            ];
		}else{
            $msg=[
                'code'=>'200',
                'msg'=>'del success'
            ];
        }
		return $msg;
    }

    public function studenteditview($studentid){
        $table="student_info";
        $lists = Db::connect($this->connection)->table($table)->where('studentid',$studentid)->find();
        $table="group_info";
        $group = [];
        $groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $data=['group'=>$group,'lists'=>$lists];
    }

    public function studentedit($data){
        $validate=new StudentEdit();
        $checkres=$validate->check($data);
        if($checkres){
            $table="student_info";
            $studentid=$data['studentid'];
            $newdata=[
                'name'=>$data['name'],
                'email'=>$data['email'],
                'groupid'=>$data['groupid'],
                'sex'=>$data['sex'],
                'status'=>$data['status']
            ];
            $res = Db::connect($this->connection)->table($table)
                        ->where('studentid',$studentid)
                        ->update($newdata);
            if($res){
                $msg=[
                    'code'=>"200",
                    'msg'=>'update success'
                ];
            }else{
                $msg=[
                    'code'=>"1254421",
                    'msg'=>'update fail'
                ];
            }
            return $msg;
        }else{
            return ['code'=>"90000",'msg'=>$validate->getError()];
        }
    }

    public function tempstudentinfo(){
        $table="Temp_student";
        $lists = Db::connect($this->connection)->table($table)->paginate(5,20);
        $page = $lists->render();

        $college=[];
        $collegetb="college_info";
        $colleges=Db::connect($this->connection)->table($collegetb)->select();
        if(!empty($colleges)){
            foreach ($colleges as $key => $value) {
                $college[$value['collegecode']] = $value;
            }
        }

        $faculty=[];
        $facultytb="faculty_info";
        $facultys=Db::connect($this->connection)->table($facultytb)->select();
        if(!empty($facultys)){
            foreach ($facultys as $key => $value) {
                $faculty[$value['facultycode']] = $value;
            }
        }

        $major=[];
        $majortb="major_info";
        $majors=Db::connect($this->connection)->table($majortb)->select();
        if(!empty($majors)){
            foreach ($majors as $key => $value) {
                $major[$value['majorcode']] = $value;
            }
        }

        $table="group_info";
		$group = [];
		$groups = Db::connect($this->connection)->table($table)->select();
        if(!empty($groups)){
            foreach ($groups as $key => $value) {
                $group[$value['groupid']] = $value;
            }
        }
        return $data=[
            'lists'=>$lists,
            'group'=>$group,
            'college'=>$college,
            'faculty'=>$faculty,
            'major'=>$major,
            'page'=>$page
            ];
    }

    public function tempstudentadd($studentid){
        $table="student_info";
        $test=Db::connect($this->connection)->table($table)
                    ->field("studentid")
                    ->where("studentid",$studentid)
                    ->findOrEmpty();
        if(!empty($test)){
            $table="temp_student";
            $res=Db::connect($this->connection)->table($table)
                ->where('studentid',$studentid)->delete();
            return [
                'code'=>'852',
                'msg'=>"user is ex"
            ];
        }
        $table="temp_student";
        $res=Db::connect($this->connection)->table($table)
                ->where('studentid',$studentid)
                ->find();
        $newdata=[
            'studentid'=>$res['studentid'],
            'name'=>$res['studentname'],
            'sex'=>$res['sex'],
            'email'=>$res['email'],
            'password'=>$res['password'],
            'collegecode'=>$res['collegecode'],
            'facultycode'=>$res['facultycode'],
            'majorcode'=>$res['majorcode'],
            'class'=>$res['class'],
        ];
        $table="student_info";
        $result=Db::connect($this->connection)->table($table)->insert($newdata);
        $table="temp_student";
        $res=Db::connect($this->connection)->table($table)
            ->where('studentid',$studentid)
            ->update(['checked'=>1]);
        return $msg=['code'=>'200','msg'=>'insert success'];
    }

    public function tempstudentnopass($data){
        $table="temp_student";
		$res = Db::connect($this->connection)->table($table)
                            ->where('studentid',$data)->update(['checked'=>2]);
		if(empty($res)){
			$msg=[
                'code'=>'234',
                '$msg'=>'update fail'
            ];
		}else{
            $msg=[
                'code'=>'200',
                'msg'=>'update success'
            ];
        }
		return $msg;
    }

    public function tempstudentdel($data){
        $table="temp_student";
		$res = Db::connect($this->connection)->table($table)
                            ->where('studentid',$data)->delete();
		if(empty($res)){
			$msg=[
                'code'=>'234',
                '$msg'=>'del fail'
            ];
		}else{
            $msg=[
                'code'=>'200',
                'msg'=>'del success'
            ];
        }
		return $msg;
    }
}