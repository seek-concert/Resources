<?php
/**
 * 后台控制器
 */
namespace app\admin\controller;

class Document extends Init
{
    public function document_lists(){
        $param = input('param.');
        $page = isset($param['page'])?$param['page']:1;
        $sqlmap = [];
        $lists = model('Content')->where($sqlmap)->limit->(25)->page($page)->select();
        $lists_count = model('Content')->where($sqlmap)->count();
    }
}