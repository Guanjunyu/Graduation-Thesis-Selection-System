<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class IndexLogin extends Validate
{
    protected $regex=[
        'userid1' => '/^[0-9]{12}$/i',
        'password' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&_])[A-Za-z\d$@$!%*?&]{8,20}/'
    ];
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *具体可参考开发文档中的"验证"
     * @var array
     */
    protected $rule = [
        'username'=>'require|number|length:12|regex:userid1',
        'password'=>'require|length:8,20|regex:password',
        'role'=>'require|alpha',
        //'captcha' => 'require|captcha'
    ];
    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'captcha.captcha' => '验证码错误',
        'username.number'=>'账号只能为数字',
        'username.length:12'=>'账号格式不正确',
        'password.length:8,20'=>'密码长度不够',
        'password.regex|password'=>'密码不符合要求',
    ];

}
