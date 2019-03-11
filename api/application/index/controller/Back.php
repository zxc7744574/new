<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\BackUser as Users;
use app\index\model\Blog as Blogs;

class Back extends Controller
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    //显示文章主页
    public function index()
    {

    }

    public function ms()
    {
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        $data = json_decode(file_get_contents('php://input'),true);
        if(isset($data['page']) && !isset($data['value']) && !isset($data['input'])){ //默认页面
            $list['list'] = Blogs::limit(($data['page']-1)*10,10)->select();
            $list['num'] = Blogs::count();
            return json($list);
        }else {
            if(isset($data['value']) && !isset($data['input'])){
                $where['type'] =  $data['value'];
            }elseif(!isset($data['value']) && isset($data['input'])) {
                $where['name'] =  array('LIKE','%'.$data['input'].'%');
            }elseif(!isset($data['value']) && !isset($data['input'])) {
                $where = '';
            }else {
                $where['type'] =  $data['value'];
                $where['name'] =  array('LIKE','%'.$data['input'].'%');
            }
            $list['list'] = Blogs::where($where)->limit(0,10)->select();
            $list['num'] = Blogs::where($where)->count();
            return json($list);
        }
    }

    //登录账号
    public function login(){
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
        $data = json_decode(file_get_contents('php://input'),true);
        $info = Users::where($data)->find();
        if($info){
            $mes['code'] = "2000";
            $mes['data'] = array("token" => "admin");
            return json_encode($mes);
        }else {
            echo 2;
        }
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
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
        $data = json_decode(file_get_contents('php://input'),true);
        $info['id'] = (int)$data['id'];
        $info['name'] = $data['form']['name'];
        $info['title'] = $data['form']['title'];
        $info['content'] = $data['form']['content'];
        $info['update_time'] = time();
        $info['status'] = $data['form']['status'];
        $info['type'] = $data['form']['type'];
        return Blogs::update($info);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
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
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');  
        $data = json_decode(file_get_contents('php://input'),true);
        $id = $data['id'];
        return Blogs::destroy($id);
    }

    public function delall()
    {
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');  
        $data = json_decode(file_get_contents('php://input'),true);
        $info = $data['list'];
        if(is_array($info)){
            foreach($info as $key => $value){
                Blogs::destroy($value['id']);
            }
        }else {
            return 2;
        }
        return 1;
    }

}
