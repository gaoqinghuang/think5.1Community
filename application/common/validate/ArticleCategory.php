<?php


namespace app\common\validate;


use think\Validate;

class ArticleCategory extends Validate
{
    protected $rule = [
        'name|标题' => ['require','length'=>'3,20','chsAlpha'],
    ];
}