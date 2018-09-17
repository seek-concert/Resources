<?php
/**
 * 后台控制器
 */
namespace app\admin\controller;

class Index extends Init
{

    /**
     * 后台登录
     * @author Leimon <6230200@qq.com>
     * @copyright: 137团队
     * @date：2018-6-23
     * @version：1.0
     */
    public function login(){
        //$captcha = new Captcha();
        if (request()->isPost()){
            $param = input('post.');
            $username = isset($param['username'])?$param['username']:'';
            if($username == ''){
                $this->error('用户名不能为空');
            }

            $password = isset($param['password'])?$param['password']:'';
            if($password == ''){
                $this->error('填写密码不能为空');
            }
            $code = isset($param['code'])?$param['code']:'';
            if($code == ''){
                $this->error('填写验证码不能为空');
            }
            $index_logic = new \app\admin\logic\Index();
            $ret = $index_logic->admin_login($param);
            if(!$ret){
                $this->error($index_logic->getError(),request()->action());
            }else{
                $this->success($index_logic->getSuccess(),url('index'));
            }
        }
        return view();
    }

    /**
     * 后台首页
     * @author Leimon <6230200@qq.com>
     * @copyright: 137团队
     * @date：2018-6-23
     * @version：1.0
     */
    public function index(){
        $userid = cookie('admin_userid');
        $node_arr = get_child(0);
        $this->assign('node_arr',$node_arr);
        return view();
    }

   
}