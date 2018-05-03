<?php


namespace app\common\model;


use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp = true;

    public function getIsAdminAttr($value)
    {
        $status = ['普通会员','管理员'];
        return $status[$value];
    }

    public function getStatusAttr($value)
    {
        $status = ['禁用','启动'];
        return $status[$value];
    }

    public function setPasswordAttr($value)
    {
        return sha1($value);
    }
}