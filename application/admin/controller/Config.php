<?php
/*
|--------------------------------------------------------------------------
| 网站配置管理
|--------------------------------------------------------------------------
*/
namespace app\admin\controller;


use app\admin\model\Configs;
use think\Request;

class Config extends Base
{
    /* ========== 初始化 ========== */
    public function _initialize()
    {
        parent::_initialize();
    }

    /* ========== 配置管理 ========== */
    public function config_web()
    {
        $param = input();
        if(Request()->isPost()){
            $rule = [
                ['webname', 'require', '请填写站点名称!']
            ];
            $result = $this->validate($param, $rule);
            if (true !== $result) {
                return $this->error($result);
            }

            $model = new Configs();
            $rs =  $model->save($param,['id'=>$param['id']]);
            if($rs){
                return $this->success('配置成功!',url('config/config_web'));
            }else{
                return $this->error('配置失败!');
            }
        }
        $config = Configs::where(['id'=>1])->find();
        $this->assign([
            'infos'=>$config
        ]);
        return view();
    }
}