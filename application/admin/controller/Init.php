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
     * 判断是否登录
     * @author：xuewl01 <xuewl@xuewl.cn>
     * @copyright: 雪毅网络官方团队
     * @date：2016-07-12
     * @version：1.0
    */
    final public function is_login() {  
        if(request()->controller() == 'Index' && request()->action() == 'login') {
            return true;
        } else {
            $userid = cookie('userid');
            if(session('?userid') === FALSE || session('?roleid') === FALSE || $userid != session('userid')) {
                $this->error('您尚未登录', url('Admin/Index/login'));
            }
        }
    }
}