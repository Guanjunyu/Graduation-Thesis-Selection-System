<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class AdminEdit extends Validate
{
    protected $regex = [
        //不允许有特殊字符并且不能以下划线开头或结尾
        'name1' => '/^(?!_)(?!.*?_$)[a-zA-Z0-9_\x7f-\xff]+$/', 
    ];
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'name'=>'require|regex:name1',
        'email'=>'require|email',
        'groupid'=>'require|number',
        'sex'=>'require|in:1,0',
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
