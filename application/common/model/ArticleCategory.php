<?php


namespace app\common\model;


use think\Model;

class ArticleCategory extends Model
{
    protected $autoWriteTimestamp = true;
    protected $dateFormat = 'Y年m月d日';

    protected $auto = [];

    protected $insert = ['status'=>1];
}