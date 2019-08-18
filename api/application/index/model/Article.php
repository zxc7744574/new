<?php
namespace app\index\model;
use think\Model;

class Article extends Model
{
    protected $table = 'article';
    protected function getAddtimeAttr($addtime) {
        return date('Y-m-d',$addtime);
    }
}