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
        
    }

     /**
     * 生成节点
     * @author Leimon <6230200@qq.com>
     * @copyright: 137团队
     * @date：2018-6-23
     * @version：1.0
     */
    public function get_node(){
        $userid = cookie('admin_userid');
        $node = model('node')->where(['parentid'=>0])->select();
        $node_arr = [];
        foreach ($node as $key => $value) {
            $node_arr[] = $value->toArray();
        }
        return $node_arr;
    }
}