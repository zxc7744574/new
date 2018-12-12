<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Blog as Blogs;

class Blog extends Controller
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $page = $_GET["page"];
        $list = Blogs::limit(4*($page-1),4)->select();
        return json($list);
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
        $data = Blogs::get($id);
        return json($data);
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
