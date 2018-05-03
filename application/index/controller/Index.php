<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\UserCustomer;
use app\validate\User;
use think\Controller;
use think\Db;
use think\facade\Request;
use think\facade\Validate;

class Index extends Base
{


    public function index()
    {
        return $this->fetch('',['name'=>'xiaogao']);
    }


}
