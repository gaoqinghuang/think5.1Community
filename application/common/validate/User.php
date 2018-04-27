<?php

namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name|姓名' => ['require','length'=>'5,20','chsAlphaNum'=>5],
        'email|邮箱' => ['require','email','unique'=>'user'],
        'password|密码' => ['require','length'=>'6,20','alphaNum','confirm'=>'confirm'],
        'mobile|手机号' => ['require','mobile','unique'=>'user'],
    ];
}