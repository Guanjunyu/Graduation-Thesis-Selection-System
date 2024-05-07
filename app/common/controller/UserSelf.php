<?php


namespace app\common\controller;


use think\facade\View;
use think\facade\Request;
use think\facade\Cookie;
use think\facade\Env;
use think\facade\Config;
use think\facade\Db;
use app\common\model\UserSelfAction;

/* extend userid role */
class userself extends Base
{
    protected $connection="mysql";

    public function userinfo(){
        if(Request::isPost()){
            Request::filter(['htmlspecialchars']);
            $data=Request::param();
            $UserSelfAction=new UserSelfAction();
            return $UserSelfAction->userinfoedit($this->role,$this->userId,$data);

		}else{
            $UserSelfAction=new UserSelfAction();
            $aUser=$UserSelfAction->userinfoview($this->role,$this->userId);
            View::assign([
                'aUser'=>$aUser
            ]);
			return View::fetch("userinfo");
		}
    }
}