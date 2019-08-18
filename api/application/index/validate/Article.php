<?php
namespace app\index\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'nickname' => 'require|min:5|token',
        'email' => 'require|email',
        'birthday' => 'dataFormat:Y-m:d',
    ];
}