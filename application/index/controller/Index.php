<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\Article;
use app\common\model\ArticleCategory;

use think\Db;


class Index extends Base
{


    public function index()
    {
        return $this->fetch('',['name'=>'xiaogao']);
    }

    //文章发布
    public function insert()
    {
        $this->isLogin();
        $this->assign('title','发布文章');
        $cateList = ArticleCategory::all();
        if($cateList)
        {
            $this->assign('cateList',$cateList);
        }
        else
        {
            $this->error('请添加栏目','index/index');
        }
        return $this->fetch();
    }

    //文章保存
    public function save()
    {
        if($this->request->isPost())
        {
            $data = $this->request->post();
            $res = $this->validate($data,'app\common\validate\Article');
            if(true !== $res)
            {
                echo '<script>alert("'.$res.'");location.back()</script>';
            }
            else
            {
                $file = $this->request->file('title_img');
                $info = $file->validate(['size'=>1000000,'ext'=>'jpeg,jpg,png,gif'])->move('uploads/');
                if($info)
                {
                    $data['title_img'] = $info->getSaveName();
                }
                else
                {
                    $this->error($file->getError());
                }
            }
        }
        else
        {
            $this->error('请求类型错误','insert');
        };
    }
}
