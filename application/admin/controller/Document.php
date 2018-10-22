<?php
/**
 * 后台控制器
 */
namespace app\admin\controller;
use think\Request;
class Document extends Init
{
    public function document_lists(){
        $param = input('param.');
        $page = isset($param['page'])?$param['page']:1;
        $sqlmap = [];
        $lists = model('Content')->where($sqlmap)->limit(25)->page($page)->select();
        $lists_count = model('Content')->where($sqlmap)->count();
        return view();
    }

    public function document_add(){
        if (Request::instance()->isPost()){
            $param = input('');
            $sqlmap = array();
            $sqlmap['title'] = $param['title'];
            $sqlmap['label'] = $param['label'];
            $sqlmap['content'] = $param['content'];
            $sqlmap['profile'] = $param['profile'];
            $sqlmap['release_time'] = date('Y-m-d',time());
            $ret = model('content')->save($sqlmap);
            if($ret){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }
        $node_arr = get_child(0);
        $this->assign('node_arr',$node_arr);
        return view();
    }
}