<?php
/**
 * 后台控制器
 */
namespace app\admin\controller;
use think\Request;

class Setting extends Init
{
    public function site_setting(){
        if (Request::instance()->isPost()){
            $param = input('');
            print_r($param);
            die();
        }
        $node_arr = get_child(0);
        $this->assign('node_arr',$node_arr);
        return view();
    }
}