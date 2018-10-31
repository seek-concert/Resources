<?php
/*
|--------------------------------------------------------------------------
| 常用工具  上传
|--------------------------------------------------------------------------
*/
namespace app\admin\controller;
use think\Controller;

class Tool extends Controller
{
    // 上传缩略图
    public function uploadImg()
    {
        if(request()->isAjax()){
            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploaderfile/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploaderfile' . DS .'admin');
            if($info){
                $src =  '/uploaderfile' . '/' .'admin'.'/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }
}