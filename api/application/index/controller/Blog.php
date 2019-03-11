<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Blog as Blogs;
use app\index\model\User as Users;

class Blog extends Controller
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    //显示文章主页
    public function index()
    {
        $page = $_GET["page"];
        $type = $_GET["type"];
        if($type == '1-0'){
            $list['info'] = Blogs::limit(4*($page-1),4)->select();
            $list['num'] = Blogs::count();
        }else {
            $num = substr($_GET["type"],-1);
            $where['type'] = substr($_GET["type"],-1);
            $list['info'] = Blogs::where($where)->limit(4*($page-1),4)->select();
            $list['num'] = Blogs::where($where)->count();
        }
        return json($list);
    }

    //显示文章详情
    public function show()
    {
        $page = $_GET["id"];
        $list = Blogs::where("id = " .$page)->find();
        return json($list);
    }

    //新增账号
    public function addform(){
        $info = $_POST;
        $data['nickname'] = $_POST['info']['acc'];
        $data['name'] = $_POST['info']['acc'];
        $data['password'] = $_POST['info']['pass'];
        $data['createtime'] = time();
        if($data){
            $info = Users::create($data);
            return json($info);
        }else {
            return false;
        }
    }

    //登录账号
    public function checkinfo(){
        $info = $_POST;
        $data['name'] = $_POST['info']['acc'];
        $data['password'] = $_POST['info']['pwd'];
        $result = $this->check($data);
        if($result){
            $_SESSION['id'] = $result->id;
            $_SESSION['nickname'] = $result->nickname;
            return json($result);
        }else {
            return 2;
        }
        exit;
    }

    public function check($data){
        return Users::where($data)->find();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->param();
        $result = Blogs::create($data);
        return json($result);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        // 指定允许其他域名访问    
        header('Access-Control-Allow-Origin:*');    
        // 响应类型    
        header('Access-Control-Allow-Methods:POST');    
        // 响应头设置    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');  
        try{
            $data = Blogs::get($id);
            if($data){
                return json($data);
            }else {
                abort(404);
            }
        } catch(\Exception $e){
            return abort(404,$e->getMessage());
        }

        
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->param();
        $result = Blogs::update($data,['id' => $id]);
        return json($result);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $result = Blogs::destroy($id);
        return json($result);
    }
}
