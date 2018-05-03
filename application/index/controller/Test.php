<?php


namespace app\index\controller;


use app\common\controller\Base;
use app\common\model\User;


class Test extends Base
{
    public function test()
    {
        $data = [
            'name' => 'xiaoghao1',
            'email'=> '6171',
            'mobile' => '2222',
            'password'=>'12456',
            'is_admin'=> 0,
        ];
        $rs =  User::create($data);
        dump($rs);die();
        if($rs)
        {
            dump(11);
        }
        else
        {
            dump(22);
        }
    }
}