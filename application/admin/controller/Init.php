<?php
/**
 * 后台
 */
namespace app\admin\controller;
use think\Controller;

class Init extends Controller
{
    public function _initialize() {
        parent::_initialize();
        $this->is_login();
    }

    /**
     * 判断是否登录  是否多处登录
     * @author：xuewl01 <xuewl@xuewl.cn>
     * @copyright: 雪毅网络官方团队
     * @date：2016-07-12
     * @version：1.0
    */
    final public function is_login() { 
       
        if(request()->controller() == 'Index' && request()->action() == 'login') {
            return true;
        }
        $userid = cookie('admin_userid');
        if(session('?admin_userid') === FALSE || session('?type') === FALSE || $userid != session('admin_userid')) {
            $this->error('您尚未登录', url('Admin/Index/login'));
        }
        echo cookie('FROMHASH');
        $login_hash = model('admin')->where(['id'=>session('admin_userid')])->column('login_hash');
        if(cookie('FROMHASH') != $login_hash){
            $this->error('您的账号在他地登陆');
        }
        
    }
}