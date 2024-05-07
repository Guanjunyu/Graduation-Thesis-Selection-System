<?php


namespace app\common\model;
use think\facade\Db;
use app\validate\ProjectCollect;


class ProjectAction
{
    protected $connection="mysql";

    public function collectprojectview($role,$userid){
        $table=$role."_info";
        $field=$role."id";
        $username=Db::connect($this->connection)->table($table)
                    ->where($field,$userid)->field("name")->find();
        $table="major_info";
        $major = [];
        $majors = Db::connect($this->connection)->table($table)->select();
        if(!empty($majors)){
            foreach ($majors as $key => $value) {
                $major[$value['majorcode']] = $value;
            }
        }
        return $data=['username'=>$username,'major'=>$major];
    }

    public function collectproject($data){
        $validate=new ProjectCollect();
        $checkres=$validate->check($data);
        if($checkres){
            //检查通过,写入数据库
            $table="temp_project";
            $newdata=[
                'projectname'=>$data['projectname'],
                'teacherid'=>$data['teacherid'],
                'majorcode'=>$data['majorcode'],
                'difficultly'=>$data['difficultly'],
                'ability'=>$data['ability'],
                'description'=>$data['description'],
                'content'=>$data['content'],
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

    public function auditprojectinfo(){
        $table="Temp_project";
        $lists = Db::connect($this->connection)->table($table)->paginate(20);
        $table="teacher_info";
		$name = [];
		$names = Db::connect($this->connection)->table($table)->field(['teacherid','name'])->select();
        if(!empty($names)){
            foreach ($names as $key => $value) {
                $name[$value['teacherid']] = $value;
            }
        }
        return $data=['lists'=>$lists,'name'=>$name];
    }

    public function auditprojectadd($id){
        $table="temp_project";
        $data=Db::connect($this->connection)->table($table)->where('Id',$id)->find();
        if($data['checked']==0){
            Db::startTrans();
            try {
                $newdata=[
                    'projectname'=>$data['projectname'],
                    'majorcode'=>$data['majorcode'],
                    'teacherid'=>$data['teacherid'],
                    'description'=>$data['description'],
                    'difficultly'=>$data['difficultly'],
                    'ability'=>$data['ability'],
                    'content'=>$data['content'],
                ];
                $table="project_info";
                $result=Db::connect($this->connection)->table($table)->insert($newdata);
        
                $table="temp_project";
                $res=Db::connect($this->connection)->table($table)
                    ->where('Id',$id)
                    ->update(['checked'=>1]);
                Db::commit();
                return $msg=['code'=>'200','msg'=>'insert success'];
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return $msg=[
                    'code'=>"2588",
                    'msg'=>$e->getMessage()
                ];
            }
        }else{
            return $msg=[
                'code'=>'200',
                'msg'=>'this is audited by one'
            ];
        }
    }

    public function auditprojectdel($Id){
        $table="temp_project";
		$res = Db::connect($this->connection)->table($table)
                            ->where('Id',$Id)->delete();
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

    public function auditprojectteacherinfo($teacherid){
        $table="Temp_project";
        $lists = Db::connect($this->connection)->table($table)
                ->where('teacherid',$teacherid)
                ->paginate(20);
        return $data=['lists'=>$lists];
    }

    public function chooseprojectinfo($uid){
        $table="student_info";
        $student=Db::connect($this->connection)->table($table)
                            ->where('studentid',$uid)
                            ->find();
        $majorcode=$student['majorcode'];
        $checked=$student['checked'];
        // halt($checked);
        $table="project_info";
        $lists = Db::connect($this->connection)->table($table)
                            ->where('majorcode',$majorcode)
                            ->paginate(1);
        $table="teacher_info";
		$name = [];
		$names = Db::connect($this->connection)->table($table)->field(['teacherid','name'])->select();
        if(!empty($names)){
            foreach ($names as $key => $value) {
                $name[$value['teacherid']] = $value;
            }
        }

        return $data=['lists'=>$lists,'name'=>$name,'checked'=>$checked];
    }

    public function showprojectdata($projectid){
        $table="project_info";
        $data = Db::connect($this->connection)->table($table)
                        ->where('projectid',$projectid)
                        ->find();
        $major=$data['majorcode'];
        $table="major_info";
        $majorname=Db::connect($this->connection)->table($table)
                        ->where('majorcode',$major)
                        ->field(['majorname'])
                        ->find();
        $data['majorname']=$majorname;
        $teacherid=$data['teacherid'];
        $table="teacher_info";
        $name= Db::connect($this->connection)->table($table)
                ->field(['name'])
                ->where('teacherid',$teacherid)
                ->find();
        $data['teachername']=$name['name'];
        return $data;
    }

    public function showtempprojectdata($Id){
        $table="temp_project";
        $data = Db::connect($this->connection)->table($table)
                        ->where('Id',$Id)
                        ->find();
        $major=$data['majorcode'];
        $table="major_info";
        $majorname=Db::connect($this->connection)->table($table)
                        ->where('majorcode',$major)
                        ->field(['majorname'])
                        ->find();
        $data['majorname']=$majorname;
        $teacherid=$data['teacherid'];
        $table="teacher_info";
        $name= Db::connect($this->connection)->table($table)
                ->field(['name'])
                ->where('teacherid',$teacherid)
                ->find();
        $data['teachername']=$name['name'];
        return $data;
    }

    public function ensureproject($projectid,$studentid){
        $protable="project_info";
        $stutable="student_info";
        //先去查询两者的状态,确实没有选题以及可以被选的
        $flagpro=Db::connect($this->connection)->table($protable)
                    ->where('projectid',$projectid)
                    ->field(['checked'])
                    ->find();
        
        $flagstu=Db::connect($this->connection)->table($stutable)
                    ->where('studentid',$studentid)
                    ->field(['checked'])
                    ->find();
        if($flagpro['checked']==0&&$flagstu['checked']==0){
            Db::startTrans(); 
            try {
                Db::connect($this->connection)->table($protable)
                ->where('projectid',$projectid)
                ->where('checked',0)
                ->update(['checked'=>1,'studentid'=>$studentid]);

                Db::connect($this->connection)->table($stutable)
                ->where('studentid',$studentid)
                ->where('checked',0)
                ->update(['checked'=>1,"projectid"=>$projectid]);
                //提交事务
                Db::commit(); 
            } catch (\Exception $e) {
                echo '执行 SQL 失败！'; 
                //回滚 
                Db::rollback(); 
                return $msg=[
                    'code'=>"12542",
                    'msg'=>"fail"
                ];
            }
            return $msg=[
                'code'=>'200',
                'msg'=>'successful'
            ];
        }
    }

    public function showsprojectstudent($studentid){
        $table="student_info";
        $data=Db::connect($this->connection)->table($table)
        ->where('studentid',$studentid)
        ->field(['projectid'])
        ->find();
        $data['studentid']=$studentid;
        $projectid=$data['projectid'];

        $table="project_info";
        $prodata = Db::connect($this->connection)->table($table)
                        ->where('projectid',$projectid)
                        ->find();
        $data['projectname']=$prodata['projectname'];
        $data['difficultly']=$prodata['difficultly'];
        $data['ability']=$prodata['ability'];
        $data['description']=$prodata['description'];
        $data['content']=$prodata['content'];
        $major=$prodata['majorcode'];
        $table="major_info";
        $majorname=Db::connect($this->connection)->table($table)
                        ->where('majorcode',$major)
                        ->field(['majorname'])
                        ->find();
        $data['majorname']=$majorname;
        $teacherid=$prodata['teacherid'];
        $table="teacher_info";
        $name= Db::connect($this->connection)->table($table)
                ->field(['name'])
                ->where('teacherid',$teacherid)
                ->find();
        $data['teachername']=$name['name'];
        return $data;
    }

    public function delproject($studentid,$projectid){
        
        $protable="project_info";
        $stutable="student_info";
        //先去查询两者的状态,确实是被选择以及是整个人选中
        $flagpro=Db::connect($this->connection)->table($protable)
                    ->where('projectid',$projectid)
                    ->field(['checked','studentid'])
                    ->find();
        
        $flagstu=Db::connect($this->connection)->table($stutable)
                    ->where('studentid',$studentid)
                    ->field(['checked','projectid'])
                    ->find();

        if(($flagpro['checked']==1&&$flagstu['checked']==1)&&($flagpro['studentid']==$studentid)&&($flagstu['projectid']=$projectid)){
            Db::startTrans(); 
            try {
                Db::connect($this->connection)->table($protable)
                ->where('projectid',$projectid)
                ->where('checked',1)
                ->update(['checked'=>0,'studentid'=>""]);

                Db::connect($this->connection)->table($stutable)
                ->where('studentid',$studentid)
                ->where('checked',1)
                ->update(['checked'=>0,"projectid"=>""]);
                //提交事务
                Db::commit();
                return $msg=[
                    'code'=>'200',
                    'msg'=>'successful'
                ]; 
            } catch (\Exception $e) {
                echo '执行 SQL 失败！'; 
                //回滚 
                Db::rollback(); 
                return $msg=[
                    'code'=>"12542",
                    'msg'=>"fail"
                ];
            }
        }else{
            return $msg=[
                'code'=>'258',
                'msg'=>'fail try agin'
            ];
        }
    }

    public function showprojectteacher($teacherid){
        $table="project_info";
        $lists=Db::connect($this->connection)->table($table)
                ->where('teacherid',$teacherid)
                ->select();

        $table="student_info";
		$name = [];
		$names = Db::connect($this->connection)->table($table)->select();
        if(!empty($names)){
            foreach ($names as $key => $value) {
                $name[$value['studentid']] = $value;
            }
        }
        return $data=['lists'=>$lists,'name'=>$name];
    } 
    
    public function showallproject($teacherid){
        $table="teacher_info";
        $teacher=Db::connect($this->connection)->table($table)
                            ->where('teacherid',$teacherid)
                            ->find();
        $majorcode=$teacher['majorcode'];
        $table="project_info";
        $lists = Db::connect($this->connection)->table($table)
                            ->where('majorcode',$majorcode)
                            ->paginate(1);
        $table="teacher_info";
		$name = [];
		$names = Db::connect($this->connection)->table($table)->field(['teacherid','name'])->select();
        if(!empty($names)){
            foreach ($names as $key => $value) {
                $name[$value['teacherid']] = $value;
            }
        }

        return $data=['lists'=>$lists,'name'=>$name];
    }

    public function statistical(){
        $table="student_info";
        $lists=Db::connect($this->connection)->table($table)->select();
        $student_info=[];
        if(!empty($lists)){
            foreach($lists as $key => $value){
                $student_info[$value['studentid']]['studentid']=$value['studentid'];
                $student_info[$value['studentid']]['name']=$value['name'];
                $student_info[$value['studentid']]['majorcode']=$value['majorcode'];
                $student_info[$value['studentid']]['checked']=$value['checked'];
                $student_info[$value['studentid']]['projectid']=$value['projectid'];
            }
        }

        $table="major_info";
        $majornames = Db::connect($this->connection)->table($table)->select();
        if(!empty($majornames)){
            foreach ($majornames as $key => $value) {
                $majorcode=$value['majorcode'];
                foreach($student_info as $key =>$value1){
                    if($majorcode==$value1['majorcode']){
                        $student_info[$key]['majorname']=$value['majorname'];
                    }
                }
                
            }
        }


        $table="teacher_info";
        $teachername=[];
        $teachernames = Db::connect($this->connection)->table($table)->select();
        if(!empty($teachernames)){
            foreach ($teachernames as $key => $value) {
                $teachername[$value['teacherid']]['name'] = $value["name"];
            }
        }

        $table="project_info";
        $proname=[];
        $pronames = Db::connect($this->connection)->table($table)->select();
        if(!empty($pronames)){
            foreach ($pronames as $key => $value) {
                $proname[$value['projectid']] = $value;
                $id=$proname[$value['projectid']]['teacherid'];
                $proname[$value['projectid']]['teachername']=$teachername[$id]['name'];
            }
        }
        

        foreach($student_info as $key =>$value1){
            foreach($proname as $key1 => $value2){
                if($key==$value2['studentid']){
                    $student_info[$key]['projectname']=$value2['projectname'];
                    $student_info[$key]['teachername']=$value2['teachername'];
                }
            }
        }
        $resdata=[];
        foreach($student_info as $key =>$value){
            $resdata[]=$value;
        }
        return $resdata;
    }

    public function statisticalsearch($data){
        if($data==""){
            return $msg=[
                'code'=>'224324',
                'msg'=>'input is empty'
            ];
        }
        $search=$data;
        // 直接查询单条数据

        $table="student_info";
        $lists=Db::connect($this->connection)->table($table)
                        ->where('name',$search)
                        ->find();
        $student_info['checked']=$lists['checked'];
        $student_info['name']=$lists['name'];
        $student_info['projecrtid']=$lists['projectid'];
        $student_info['studentid']=$lists['studentid'];
        $student_info['majorcode']=$lists['majorcode'];

        $table="major_info";
        $majorinfo=Db::connect($this->connection)->table($table)
                    ->where('majorcode',$student_info['majorcode'])
                    ->find();
        $student_info['majorname']=$majorinfo['majorname'];

        $table="project_info";
        $data=Db::connect($this->connection)->table($table)
                ->where('projectid',$student_info['projecrtid'])
                ->find();
        $student_info['projectname']=$data['projectname'];
        $student_info['teacherid']=$data['teacherid'];
        
        $table="teacher_info";
        $teachername=Db::connect($this->connection)->table($table)
                ->where('teacherid',$student_info['teacherid'])
                ->find();
        $student_info['teachername']=$teachername['name'];
        return $msg=[
            'code'=>'',
            'msg'=>'successful',
            'data'=>$student_info
        ];
    }
}