<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class UserView extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *具体可参考开发文档中的"验证"
     * @var array
     */
    protected $rule = [];
    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];


    //自定义验证规则
    // protected function 验证规则名($value,$rule){
    //     return $rule!=$value?true:错误信息;
    // }
}
