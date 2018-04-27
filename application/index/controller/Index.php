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
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function demo1()
    {
//        $rs =  Db::table('user_customer')->field(['username'=>'姓名','id'])->where('pid','=',50)->select();
        $rs =  UserCustomer::field(['username','id'])->where('pid','=',50)->select();

        var_dump($rs);

//        dump($rs instanceof UserCustomer);
    }

    public function demo2()
    {
        $rs = $this->demo3();
        dump($rs);
    }

    public static function demo3()
    {
        return self::demo4();
    }

    public function  demo4()
    {
        $obj = new \stdClass();
        dump($obj);
    }

    public function  demo5()
    {
        $data = [
            'name' => '笑傲笑傲笑傲',
            'email' => '617103154@qq.com',
            'password' => '123456',
            'mobile' => '15859573992',
        ];
        $validate = new User();
        if(!$validate->check($data))
        {
            return $validate->getError();
        }
        else
        {
            return '成功';
        }
    }

    public function demo6()
    {
        $rule = [
            'name|姓名' => ['require','max'=>20,'min'=>5],
            'email' => ['require','email'=>'email'],
            'password' => ['require','max'=>12,'min'=>3,'alphaNum'],
            'mobile' => ['require','mobile'],
        ];
        $data = [
            'name' => '笑傲笑傲笑傲',
            'email' => '617103154@qq.com',
            'password' => '123456',
            'mobile' => '15859573992',
        ];
        Validate::rule($rule);
        if(!Validate::check($data))
        {
            return Validate::getError();
        }
        else
        {
            return '成功';
        }
    }
}
