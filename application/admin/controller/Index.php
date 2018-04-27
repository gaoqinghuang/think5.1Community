<?php

namespace app\admin\controller;
use think\Container;
use think\facade\Config;

class Index
{
    public function index()
    {
        return 1;
    }
    public function get()
    {
        //dump(Config::get());
        //dump(Config::get('app.'));
        //dump(Config::pull('app'));
        //dump(Config::get('app.app_debug'));
        dump(Config::get('app_debug'));
//        dump(Config::has('app_debug'));
    }

    public function set()
    {
        dump(Config::get('app_debug'));
        dump(Config::set('app_debug',true));
        //dump(Config::get('app_debug'));
    }

    public function helper()
    {
        dump(config('?app_debug'));
        dump(config('app.app_debug',1));
        dump(config('app_debug'));
    }

    public function bind()
    {
//        $a = new \app\index\controller\Index();
//        dump($a);die();
        Container::set('demo','\app\index\controller\Index');
        $demo = Container::get('demo',['name'=>'大高1']);
//        dump($demo);
        $a = new \app\common\controller\Index();
        $b = $a->index();
        dump($b);
    }

}