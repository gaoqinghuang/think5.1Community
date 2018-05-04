<?php


namespace app\common\controller;


use app\common\model\ArticleCategory;
use think\Controller;
use think\facade\Session;

class Base extends Controller
{
    protected function initialize()
    {
        $this->showNav();
    }

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

    //显示分类导航
    private function showNav()
    {
        $cateList = ArticleCategory::all(function($query){
            $query->where('status',1)->order('sort','asc');
        });
        $this->assign('cateList',$cateList);
    }
}