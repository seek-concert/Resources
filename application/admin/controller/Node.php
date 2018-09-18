<?php
/**
 * 后台控制器
 */
namespace app\admin\controller;

class Node extends Init
{
    public function node_lists(){
        
        $node_arr = get_child(0);
        foreach ($node_arr as $key => $value) {
            $datas[$key]['id'] = $value['id'];
            $datas[$key]['text'] = $value['name'];
            $datas[$key]['tags'] = [];
            if(get_child($value['id'])){
                $datas[$key]['nodes'] = [];
                foreach (get_child($value['id']) as $k => $v) {
                    $datas[$key]['nodes'][$k]['id'] = $v['id'];
                    $datas[$key]['nodes'][$k]['text'] = $v['name'];
                    $datas[$key]['nodes'][$k]['tags'] = [];
                }
            }
        }
        $this->assign('node_arr',$node_arr);
        $this->assign('datas',$datas);
        return view();
    }

    public function get_node_api(){
        $datas = [];
        $node_arr = get_child(0);
        foreach ($node_arr as $key => $value) {
            $datas[$key]['id'] = $value['id'];
            $datas[$key]['text'] = $value['name'];
            $datas[$key]['tags'] = [];
            if(get_child($value['id'])){
                $datas[$key]['nodes'] = [];
                foreach (get_child($value['id']) as $k => $v) {
                    $datas[$key]['nodes'][$k]['id'] = $v['id'];
                    $datas[$key]['nodes'][$k]['text'] = $v['name'];
                    $datas[$key]['nodes'][$k]['tags'] = [];
                }
            }
        }
        return $datas;
    }
}