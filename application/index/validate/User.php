<?php
/**
 * Created by PhpStorm.
 * User: 52721
 * Date: 2018/6/11
 * Time: 16:30
 */
namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    #验证规则
    protected $rule = [
        'user_id' => 'require',
        'age|年龄' => 'number|between:1,120',
        'email' => 'email'
    ];

    #验证提示信息
    protected $message = [
        'user_id.require' => '用户ID必填',
        'age.number' => '年龄必须为数字',
        'email.email' => '邮箱格式错误'
    ];

    #场景
    protected $scene = [
        'edit' => ['user_id', 'age']
    ];
}