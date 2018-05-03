<?php


namespace app\common\controller;


use think\Controller;
use think\facade\Session;

class Base extends Controller
{
    protected function initialize()
    {}

    //防止重复登录
    public function isLogin()
    {
        if(!Session::has('user_id'))
        {
            $this->error('请登录后操作','user/login');
        };
    }

    //防止重复登录
    protected function logined()
    {
        if(Session::has('user_id'))
        {
            $this->error('您已登录','index/index');
        };
    }
}