<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Response;
use app\index\model\Article as ArticleModel;

class Index extends Controller
{
    public function index(Request $request,$id = '1')
    {
        // $wh['title'] = array(['like','%吕%'],['<',2],'or');
        // $wh['id'] = array('<',2);
        // $data = Db::name('article')->where($wh)->column('title');
        // return json($data);
        // $this->assign('result',$data);
        // return $this->fetch();
        // echo $list;
        $list = ArticleModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    
}
