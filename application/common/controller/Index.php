<?php

namespace app\common\controller;
use think\Container;

class Index
{
    public function index()
    {
        $demo = Container::get('demo');
        dump($demo);
        return 1;
    }
}