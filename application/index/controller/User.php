<?php


namespace app\index\controller;


use app\common\controller\Base;
use app\common\model\User as UserModel;
use think\facade\Session;


class User extends Base
{
    public function register()
    {
        $this->assign('title','用户注册');
        return $this->fetch();
    }

    public function insert()
    {
        if($this->request->isAjax())
        {
            $data = $this->request->post();
            $res = $this->validate($data,'app\common\validate\User');
            if(true !== $res)
            {
                return ['status'=>-1,'message'=>$res];
            }
            else
            {
                if(UserModel::create($data))
                {
                    return ['status'=>1,'message'=>'成功!'];
                }
                else
                {
                    return ['status'=>0,'message'=>'失败!'];
                }
            }
        }
        else
        {
            $this->error('请求类型错误','register');
        }
    }

    public function login()
    {
        $this->logined();
        return $this->fetch('',['title'=>'用户登录']);
    }

    public function loginCheck()
    {
        if($this->request->isAjax())
        {
            $data = $this->request->post();
            $rule = [
                'email|邮箱' => ['require','email'],
                'password|密码' => ['require','alphaNum'],
            ];
            $res = $this->validate($data,$rule);
            if(true !== $res)
            {
                return ['status'=>-1,'message'=>$res];
            }
            else
            {
                $result = UserModel::get(function($query) use ($data){
                    $query->where('email',$data['email'])->where('password',sha1($data['password']));
                });
                if(null == $result)
                {
                    return ['status'=>0,'message'=>'邮箱或密码不正确'];
                }
                else
                {
                    Session::set('user_id',$result->id);
                    Session::set('user_name',$result->name);
                    return ['status'=>1,'message'=>'恭喜,登录成功'];
                }
            }
        }
        else
        {
            $this->error('请求类型错误','login');
        }
    }

    public function logout()
    {
        Session::clear();
        $this->success('退出登录成功','index/index');
    }
}