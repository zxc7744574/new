<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\BackUser as Users;
use app\index\model\Blog as Blogs;
use app\index\model\Role as Roles;
use app\index\model\RoleMenu as RoleMenu;
use app\index\model\Link as Links;

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
        $info = Users::where($data['value'])->select();
        return json($info);
    }

    public function role(){
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
        $role['list'] = Roles::all();
        $rolemenu = RoleMenu::all();
        foreach($role['list'] as $k => $v){
            if(isset($v['rolelist'])){  //改造一下rolelist
                $a = json_decode($v['rolelist']);
                foreach($a as $key=>$value){
                    switch((int)$value){
                        case '1': $a[$key] = $rolemenu[0]['rolename']; break;
                        case '2': $a[$key] = $rolemenu[1]['rolename']; break;
                        case '3': $a[$key] = $rolemenu[2]['rolename']; break;
                        case '4': $a[$key] = $rolemenu[3]['rolename']; break;
                        case '5': $a[$key] = $rolemenu[4]['rolename']; break;
                        case '6': $a[$key] = $rolemenu[5]['rolename']; break;
                        default: '未知';
                    }
                }
                $v['rolelist'] = json_encode($a,JSON_UNESCAPED_UNICODE);
            }
        }
        $role['num'] = Roles::count();
        return json($role);
    }

    public function getuser(){
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
        $info['list'] = Users::field('back_user.*,authname')->join('role','back_user.role = role.id','left')->select();
        $info['num'] = Users::Count();
        return json($info);
    }

    public function getlinks(){
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
        $info['list'] = Links::All();
        $info['num'] = Links::Count();
        return json($info);                
    }

    public function rolelist(){
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');
        $lists['list'] = RoleMenu::All();
        $lists['role'] = Roles::All();
        return json($lists);
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
        // header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
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

    public function saverole(Request $request)
    {
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
        $data = json_decode(file_get_contents('php://input'),true);
        $info['id'] = (int)$data['id'];
        $info['authname'] = $data['form']['authname'];
        $menus = RoleMenu::All()->toarray();
        $bb = $data['form']['rolelist'];
        $aa = array();
        if(is_array($bb)){
            foreach($bb as $key => $value){
                foreach($menus as $k=>$v){
                if($value == $v['rolename']){
                    $aa[$key] = $v['id'];
                    }
                }
            }
        }
        $info['rolelist'] = json_encode($aa);
        $info['state'] = $data['form']['state'];
        return Roles::update($info);
    }

    public function saveuser(Request $request)
    {
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
        $data = json_decode(file_get_contents('php://input'),true);
        $info['id'] = (int)$data['id'];
        $info['username'] = $data['form']['account'];
        $info['role'] = $data['form']['role'];
        $info['password'] = $data['form']['password'];
        $info['logintime'] = time();
        $info['state'] = $data['form']['state'];
        return Users::update($info);
    }

    public function savelink(){
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
        $data = json_decode(file_get_contents('php://input'),true);
        $info['id'] = (int)$data['id'];
        $info['name'] = $data['form']['name'];
        $info['link'] = $data['form']['link'];
        $info['state'] = $data['form']['state'];
        return Links::update($info);        
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
        // header('Access-Control-Allow-Headers:x-requested-with,content-type');  
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

    public function deleteback()
    {
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');  
        $data = json_decode(file_get_contents('php://input'),true);
        $id = $data['id'];
        return Roles::destroy($id);
    }

    public function deleteuser(){
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');  
        $data = json_decode(file_get_contents('php://input'),true);
        $id = $data['id'];
        return Users::destroy($id);       
    }

    public function deletelink(){
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');  
        $data = json_decode(file_get_contents('php://input'),true);
        $id = $data['id'];
        return Links::destroy($id);         
    }

    public function delall()
    {
        header('Access-Control-Allow-Origin:*');    
        header('Access-Control-Allow-Methods:POST');    
        // header('Access-Control-Allow-Headers:x-requested-with,content-type');  
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
