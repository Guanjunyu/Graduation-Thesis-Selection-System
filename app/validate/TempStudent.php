<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class TempStudent extends Validate
{
    protected $regex = [
        'userid1' => '/^[0-9]{12}$/i',
        //不允许有特殊字符并且不能以下划线开头或结尾
        'name1' => '/^(?!_)(?!.*?_$)[a-zA-Z0-9_\u4e00-\u9fa5]+$/', 
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
        'userid' => 'require|number|length:12|regex:userid1|unique:Temp_student,studentid',
        'name' => 'require|regex:name1',
        'sex' => 'require|in:1,0',
        'email' => 'require|email|unique:Temp_student,email',
        'role' => 'require|alpha',
        'password1' => 'require|length:8,20|regex:password',
        'password2' => 'require|length:8,20|confirm:password1|regex:password',
        'college' => 'require|number|length:2',
        'faculty' => 'require|number|length:3',
        'major' => 'require|number|length:4',
        'class' => 'require|number|length:1,2',
        'captcha' => 'require|captcha'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'captcha.captcha' => '验证码错误',
        'college.number'=>'请先选择学院',
        'faculty.number'=>'请先选择系',
        'major.number'=>'请先学长专业',
        'class.number'=>'请先选择班级'
    ];
}
