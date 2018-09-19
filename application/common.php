<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Config;

/**
 * 校验验证码
 * @author xuewl <master@xuewl.cn>
 *  $string string 传入的验证码
 *  $reset ture 销毁验证码 false 只用于检测
 * @copyright: 雪毅网络官方团队
 * @date：2016-07-12
 * @version：1.0
 */
function checkVerify($string, $reset = TRUE) {
	if($reset == TRUE){
		return captcha_check($string);
	}
    return captcha_check($string,'',array('reset'=>false));
}

/**
 * 随机字符串
 * @return bool
 * @author xuewl <master@xuewl.cn>
 * @copyright: 雪毅网络官方团队
 * @date：2016-07-12
 * @version：1.0
 **/
function random($length, $numeric = 0) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	if($numeric) {
		$hash = '';
	} else {
		$hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
		$length--;
	}
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}
	return $hash;
}
/**
 * 获取子节点
 * @return bool
 * @author xuewl <master@xuewl.cn>
 * @copyright: 雪毅网络官方团队
 * @date：2016-07-12
 * @version：1.0
 **/
function get_child($parentid = 0){
	$node = model('admin/node')->where(['parentid'=>$parentid])->select();
	$node_arr = [];
	foreach ($node as $key => $value) {
		$node_arr[] = $value->toArray();
	}
	return $node_arr;
}

/**
 * 获取SEO
 * @return bool
 * @author xuewl <master@xuewl.cn>
 * @copyright: 雪毅网络官方团队
 * @date：2016-07-12
 * @version：1.0
 **/

 function get_seo(){
	 //seo配置获取
	 $seo_config = config('seo');
	 //当前层
	 $m =  request()->module();
	 //当前控制器
	 $c = request()->controller();
	 //当前action
	 $a = request()->action();
	 $page_seo =  $seo_config[$m][$c][$a];
	 return $page_seo;
 }
