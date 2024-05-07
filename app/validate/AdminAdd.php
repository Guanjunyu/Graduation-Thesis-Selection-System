<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class AdminAdd extends Validate
{
    protected $regex = [
        'userid1' => '/^[0-9]{12}$/i',
        'name1' => '/^(?!_)(?!.*?_$)[a-zA-Z0-9_\x7f-\xff]+$/',
        'name2' => '/^\w*[a-zA-Z_]+\w*$/',
        'password' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&_])[A-Za-z\d$@$!%*?&]{8,20}/',
    ];
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'adminid'=>'require|number|length:12|regex:userid1|unique:admin_info,adminid',
        'password'=>'require|length:8,20|regex:password',
        'name'=>'require',
        'sex'=>'require|in:1,0',
        'email'=>'require|email|unique:admin_info,email',
        'groupid'=>'require',
        'status'=>'require|in:1,0'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
}
