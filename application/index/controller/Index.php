<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\Article;
use app\common\model\ArticleCategory;

use think\Db;
use think\facade\Request;


class Index extends Base
{

    public function index()
    {
        $map = [];
        $map[] = ['status','=',1];
        $keywords = Request::param('keywords');
        if(!empty($keywords))
        {
            $map[] = ['title','like','%'.$keywords.'%'];
        }
        $cateId = Request::param('cate_id');
        if(isset($cateId))
        {
            $res = ArticleCategory::get($cateId);
            $cateName = $res->name;
            $map[] = ['cate_id','=',$cateId];
        }
        else
        {
            $cateName = '全部文章';
        }

        $artList = Db::table('zh_article')->where($map)->order('create_time','desc')->paginate(3);
        $this->view->assign('artList', $artList);
        $this->view->assign('cateName', $cateName);
        return $this->fetch('',['title'=>'社区问答']);
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
                if(Article::create($data))
                {
                    $this->success('文章发布成功','index');
                }
                else
                {
                    $this->success('文章发布失败');
                }
            }
        }
        else
        {
            $this->error('请求类型错误','insert');
        };
    }

    //文章详情页
    public function detail()
    {
        $artId = Request::param('id');
        $art = Article::get(function($query) use ($artId){
            $query->where('id',$artId)->setInc('pv');
        });
        $this->view->assign('art',$art);
        return $this->view->fetch('',['title'=>'详情页']);
    }

    //收藏
    public function fav()
    {
        $this->isLogin();
        if(!Request::isAjax())
        {
            return ['status' => -1,'message' => '请求类型错误'];
        }
        $data = Request::param();
        $map[] = ['user_id','=', $data['user_id']];
        $map[] = ['art_id','=', $data['article_id']];

        $fav = Db::table('zh_user_fav')->where($map)->find();
        if(is_null($fav))
        {
            Db::table('zh_user_fav')->data(['user_id' => $data['user_id'],'art_id' => $data['article_id']])->insert();
            return ['status' => 1,'message' => '收藏成功'];
        }
        else
        {
            Db::table('zh_user_fav')->where($map)->delete();
            return ['status' => 0,'message' => '已取消'];
        }
    }
}
