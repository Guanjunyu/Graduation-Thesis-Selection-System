<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class ResetAccount extends Validate
{
    protected $regex = [
        'userid1' => '/^[0-9]{12}$/i',
    ];
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [

        'username'=>'require|number|length:12|regex:userid1',
        'email' => 'require|email',
        'role' => 'require|alpha',
        //'captcha' => 'require|captcha'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
}
