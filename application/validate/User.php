<?php

namespace app\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name|姓名' => ['require','max'=>20,'min'=>5],
        'email' => ['require','email'=>'email'],
        'password' => ['require','max'=>12,'min'=>3,'alphaNum'],
        'mobile' => ['require','mobile'],
    ];
}