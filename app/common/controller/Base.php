<?php


namespace app\common\controller;


use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use think\facade\Cookie;
use think\facade\Env;
use think\facade\Config;
use think\exception\HttpResponseException;


class base
{
    public $userId= null;
    public $role= null;
    
    //魔术方法自动执行
	public function __construct(){

        //未获取到cookie中设置的username和role,跳转至登录页面
        $this->userId = Cookie::get('username');
        $this->role=Cookie::get('role');
        if(empty($this->userId)||empty($this->role)){
			header('Location:/');
			exit;
		}

        //账号状态查询
        $aUser=Db::connect('mysql')->table($this->role."_info")
                                    ->where($this->role."id",$this->userId)
                                    ->find();
		if (empty($aUser)) {
			Cookie::delete('username');
			$this->error('该账户不存在');
		}
		if ($aUser['status'] != 0) {
			Cookie::delete('admin_id');
			$this->error('该已被禁用');
		}

        /* url访问权限控制 
        *  获取URL-->获取到menu中smid
        *  然后和用户组中的right对比判断是否允许访问
        * index页面和welcome页面直接放行
        *
        */
        //  $controller=request()->controller();
        //  $action=request()->action();

        //  $key="/Common/".$controller.'/'.$action;
        
        //  if($key!="/Common/Index/index"&&$key!="/Common/Index/welcome"){
        //      $menu=Db::connect('mysql')->table('index_menu')->where('src',$key)->find();
        //      if(empty($menu)){
        //          $this->error("error");
        //      }
        //      //admin_info
        //      $table="group_info";
        //      $group=Db::connect("mysql")->table($table)->where('groupid',$aUser['groupid'])->find();
        //      if(empty($group)){
        //          $this->error("no right");
        //      }else{
        //          $rights=json_decode($group['right']);
        //          if(!in_array($menu['smid'],$rights)){
        //              $this->error("no ");
        //          }
        //      }
        //  }

        
    }

    /**
     * 操作错误跳转的快捷方法
     * @access protected
     * @param  mixed     $msg 提示信息
     * @return void
     */
    protected function error($msg = '')
    {
        $result = [
            'code' => 0,
            'msg'  => $msg
        ];
		$response = view(Config::get('app.dispatch_error_tmpl'), $result);
        throw new HttpResponseException($response);
    }
}