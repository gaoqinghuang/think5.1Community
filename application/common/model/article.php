<?php


namespace app\common\model;


use think\Model;

class Article extends Model
{
    protected $autoWriteTimestamp = true;
    protected $dateFormat = 'Y年m月d日';

    protected $auto = [];

    protected $insert = ['status'=>1,'is_top'=>0,'is_hot'=>0];


}