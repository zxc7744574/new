<?php
namespace app\index\model;

use think\Model;

class Blog extends Model {
    protected $autoWriteTImestamp =  true;
    protected $insert = ['status' => 1];
    protected $field = [
        'id' => 'int',
        'create_time' => 'int',
        'update_time' => 'int',
        'name','title','content'
    ];


}