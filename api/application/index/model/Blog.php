<?php
namespace app\index\model;

use think\Model;

class Blog extends Model {
    // 开启自动写入时间戳
    protected $autoWriteTImestamp =  true;
    // 定义自动完成的属性
    protected $insert = ['status' => 1];
    protected $dateFormat = 'Y-m-d';
    protected $field = [
        'id' => 'int',
        'create_time' => 'int',
        'update_time' => 'int',
        'name','title','content'
    ];
    


}