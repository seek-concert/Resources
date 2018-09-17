<?php
/**
 * 公共上传.
 */
namespace app\tool\controller;
use think\Controller;

class Uploader extends Controller
{
    public function uploader_img(){
        $param = input('');
        $image = $param['src'];
        $type = $param['type'];
        $imageName = "25220_".date("His",time())."_".rand(1111,9999).'.png';
        if (strstr($image,",")){
            $image = explode(',',$image);
            $image = $image[1];
        }

        $path = "uploaderfile/".$type;
        if (!is_dir($path)){ //判断目录是否存在 不存在就创建
            mkdir($path,0777,true);
        }
        $imageSrc=  $path."/". $imageName;  //图片名字
        $r = file_put_contents(ROOT_PATH ."public/".$imageSrc, base64_decode($image));//返回的是字节数
        if ($r) {
            $this->success($imageSrc,'上传成功',1);
        }else{
            $this->success($imageSrc,'上传失败',0);
        }
    }
}