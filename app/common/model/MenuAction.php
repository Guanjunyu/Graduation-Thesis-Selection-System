<?php


namespace app\common\model;
use think\facade\Db;


class MenuAction 
{
    protected $connection = 'mysql';
    protected $table="index_menu";
    
    /* 导航信息展示 */
    public function menuinfo(){
        $lists = Db::connect($this->connection)->table($this->table)
        ->where('parentid',0)
        ->order('sort DESC,smid DESC')
        ->select();
        return $lists;
    }

    /*导航添加
    *   data[]=[lable,sort,status,type]
    *
    */
    public function menuadd($data){
        $newdata=[
            'lable'=>$data['lable'],
            'sort'=>$data['sort'],
            'status'=>$data['status'],
            'type'=>$data['type'],
            "icon_class"=>""
        ];
        if($data['type']==0){
            $newdata['src']="";
        }
        else if($data['type']==1){
            $newdata['src']=$data['src1'];
        }
        else if($data['type']==2){
            $newdata['src']=$data['src2'];
        }
        else{
            $msg=[
                'code'=>'90001',
                'msg'=>'insert fail'
            ];
            return $msg;
        }
        $res=Db::connect($this->connection)->table($this->table)
                                ->insert($newdata);
        if($res){
            $msg=[
                'code'=>'200',
                'msg'=>'insert success'
            ];
        }else{
            $msg=[
                'code'=>'90001',
                'msg'=>'insert fail'
            ];
        }
        return $msg;
    }

    /*导航修改
    *   data[]=[smid,lable,sort,status]
    *
    */
    public function menuedit($data){
        if($data['status']==1){
            $res = Db::connect($this->connection)->table($this->table)
            ->where('smid',$data['smid'])
            ->update(['lable'=>$data['lable'],'sort'=>$data['sort'],'status'=>$data['status']]);
            if($res){
                $msg=[
                    'code'=>'200',
                    'msg'=>'update success'
                ];
            }else{
                $msg=[
                    'code'=>'90001',
                    'msg'=>'update fail'
                ];
            }
            return $msg;
        }
        else if($data['status']==0){
            //查询子菜单
            $child=Db::connect($this->connection)->table($this->table)
                    ->where('parentid',$data['smid'])
                    ->select();
            // 没有子菜单直接添加        
            if(empty($child)){
                $res = Db::connect($this->connection)->table($this->table)
                ->where('smid',$data['smid'])
                ->update(['lable'=>$data['lable'],'sort'=>$data['sort'],'status'=>$data['status']]);
                if($res){
                    $msg=[
                        'code'=>'200',
                        'msg'=>'update success'
                    ];
                }else{
                    $msg=[
                        'code'=>'90001',
                        'msg'=>'update fail'
                    ];
                }
            }
            //存在子菜单,遍历将子菜单的状态禁用,并修改自己的数据
            else{
                $length=count($child);
                //遍历将子菜单的状态禁用
                for($i=0;$i<$length;$i++){
                    $item=$child[$i];
                    $item['status']=0;
                    Db::connect($this->connection)->table($this->table)
                    ->where('smid',$item['smid'])
                    ->update(['status'=>$item['status']]);
                }
                //修改自己的数据
                $res = Db::connect($this->connection)->table($this->table)
                ->where('smid',$data['smid'])
                ->update(['lable'=>$data['lable'],'sort'=>$data['sort'],'status'=>$data['status']]);
                if($res){
                    $msg=[
                        'code'=>'200',
                        'msg'=>'update success'
                    ];
                }else{
                    $msg=[
                        'code'=>'90001',
                        'msg'=>'update fail'
                    ];
                }
                return $msg;
            }
        }
        else{
            $msg=[
                'code'=>'90001',
                'msg'=>'status is empty'
            ];
            return $msg;
        }
    }

    public function menueditview($data){
        $lists = Db::connect($this->connection)->table($this->table)
        ->where('smid',$data)
        ->find();
        return $lists;
    }

    /*导航删除
    *   data[]=[smid]
    *   bug 删除只是删除一个没有删除子项
    */
    public function menuedel($data){

        //查询子菜单
        $child=Db::connect($this->connection)->table($this->table)
                            ->where('parentid',$data['smid'])
                            ->select()->toArray();
        //是否存在子菜单，存在删除，不存在直接跳过
        if(!empty($child)){
            //删除子菜单
            $res1=Db::connect($this->connection)->table($this->table)
                                ->where('parentid',$data['smid'])
                                ->delete();
            if(empty($res1)){
                $msg=[
                    'code'=>'125',
                    'msg'=>'child emu is fail del'
                ];
                return $msg;
            }
        }

		$res = Db::connect($this->connection)->table($this->table)
                                ->where('smid',$data['smid'])
                                ->delete();
        if(empty($res)){
            $msg=[
                'code'=>'90001',
                'msg'=>'del fail'
            ];
        }
        else{
            $msg=[
                'code'=>'200',
                'msg'=>'del success'
            ];
        }
        return $msg;
    }

    public function nextmenu($data){
        $lists = Db::connect($this->connection)->table($this->table)
        ->where('parentid',$data)
        ->select()
        ->toArray();
        if(empty($lists)){
            return $msg=[
                'code'=>'201',
                'msg'=>"no exits next menu"
            ];
        }else{
            return $msg=[
                'code'=>'200'
            ];
        }
    }

    /* 下级菜单展示 */
    public function buttoninfo($data){
        $lists = Db::connect($this->connection)->table($this->table)
                            ->where('parentid',$data['smid'])
                            ->order('sort DESC')
                            ->select()
                            ->toArray();
        if(!empty($lists)){
			foreach($lists as &$v){
				switch ($v['type']) {
					case 0:
						$v['type_name'] = '分组';
						break;
					case 1:
						$v['type_name'] = '内部跳转';
						break;
					case 2:
						$v['type_name'] = '超链接';
						break;
					case 3:
						$v['type_name'] = '隐藏按钮';
						break;
					default:
						$v['type_name'] = '未规划类型';
						break;
				}
			}
            return $msg=[
                'code'=>"200",
                'msg'=>"",
                'data'=>$lists
            ];
		}
        else{
            return $msg=[
                'code'=>"201",
                'msg'=>"not next menu"
            ];
        }

    }

    
}