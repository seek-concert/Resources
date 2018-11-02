<?php
/**
 * 公共上传.
 */
namespace app\tool\controller;
use think\Controller;

class Tool extends Controller
{
    
    public function select_area(){
        $seo = get_seo();
        $area_model = model('admin/Area');  
        $province_lists = $area_model->where(['parentid'=>100000])->select();
        $city_lists =  $area_model->where(['parentid'=>$province_lists[0]['id']])->select();
        $area_lists =  $area_model->where(['parentid'=>$city_lists[0]['id']])->select();
        $this->assign('province_lists',$province_lists);
        $this->assign('city_lists',$city_lists);
        $this->assign('area_lists',$area_lists);
        $this->assign('seo',$seo);
        $this->assign('action',request()->controller());
        return  view();
    }

    public function select_next_area($parentid = 0){
        $area_model = model('admin/Area'); 
        $param = input('');
        $parentid = $param['parentid'];
        $sqlmap = [];
        $sqlmap['parentid'] = $parentid;
        $lists = $area_model->where($sqlmap)->select();
        $lists = objToArray($lists);
        if($lists){
            $this->success('获取数据成功','',$lists);
        }
    }
}