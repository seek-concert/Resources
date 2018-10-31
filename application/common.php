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


/**
 * 统一返回信息
 * @param $code
 * @param $data
 * @param $msg
 * @return array
 */
function msg($code, $data, $msg)
{
    return compact('code', 'data', 'msg');
}

/**
 * 整理菜单住方法
 * @param $param
 * @return array
 */
function prepareMenu($param)
{
    $param = objToArray($param);
    $parent = []; //父类
    $child = [];  //子类

    foreach($param as $key=>$vo){

        if(0 == $vo['type_id']){
            $vo['href'] = '#';
            $parent[] = $vo;
        }else{
            $vo['href'] = url($vo['control_name'] .'/'. $vo['action_name']); //跳转地址
            $child[] = $vo;
        }
    }

    foreach($parent as $key=>$vo){
        foreach($child as $k=>$v){

            if($v['type_id'] == $vo['id']){
                $parent[$key]['child'][] = $v;
            }
        }
    }
    unset($child);

    return $parent;
}

/**
 * 拼装操作按钮
 * @param $contrl
 * @param $id
 * @return array
 */
function makeButton($contrl,$id)
{
    return [
        '编辑' => [
            'href' => url($contrl.'/edit', ['id' => $id]),
            'btnStyle' => 'primary',
            'icon' => 'fa fa-paste'
        ],
        '删除' => [
            'href' => "javascript:del(" .$id .")",
            'btnStyle' => 'danger',
            'icon' => 'fa fa-trash-o'
        ]
    ];
}

/**
 * 生成操作按钮
 * @param array $operate 操作按钮数组
 * @return  string
 */
function showOperate($operate = [])
{
    if(empty($operate)){
        return '';
    }

    $option = '';
    foreach($operate as $key=>$vo){
        $option .= ' <a href="' . $vo['href'] . '"><button type="button" class="btn btn-' . $vo['btnStyle'] . ' btn-sm">'.
            '<i class="' . $vo['icon'] . '"></i> ' . $key . '</button></a>';
    }

    return $option;
}

/** 批量 更新或插入数据的sql
 * @param string $table         数据表名
 * @param array $insert_columns 数据字段
 * @param array $values         原始数据
 * @param array|string $update_columns 更新字段
 * @return bool|array          返回false(条件不符)，返回array(sql语句)
 */
function batch_update_or_insert_sql($table='', $insert_columns=[], $values=[], $update_columns=[]){
    if(empty($table) || empty($insert_columns) || empty($values) || empty($update_columns)){
        return false;
    }
    // 数据字段必须包含更新字段
    if(is_string($update_columns)){
        if(!in_array($update_columns,$insert_columns)){
            return false;
        }
    }else{
        $common_columns= array_intersect($insert_columns,$update_columns);
        sort($common_columns);
        sort($update_columns);
        if($common_columns != $update_columns){
            return false;
        }
    }

    //数据字段
    $sql_insert_columns=[];
    foreach ($insert_columns as $insert_column){
        $sql_insert_columns[]='`'.$insert_column.'`';
    }
    $sql_insert_columns=implode(',',$sql_insert_columns);
    //数据分页
    $num=100;
    $page_values=[];
    foreach ($values as $k=>$value){
        $p=ceil(($k+1)/$num);
        $temp_values=[];
        foreach ($insert_columns as $insert_column){
            $temp=(string)$value[$insert_column] or '';
            $temp_values[]="'".$temp."'";
        }
        $temp_values=implode(',',$temp_values);
        $page_values[$p][]='('.$temp_values.')';
    }
    //更新字段
    if(is_string($update_columns)){
        $sql_update_columns= ' `'.$update_columns.'` = values(`'.$update_columns.'`) ';
    }else{
        $sql_update_columns=[];
        foreach ($update_columns as $update_column){
            $sql_update_columns[]= ' `'.$update_column.'` = values(`'.$update_column.'`) ';
        }
        $sql_update_columns=implode(',',$sql_update_columns);
    }
    // 生成sql
    $sqls=[];
    foreach($page_values as $p=>$value){
        $sql_values=implode(',',$value);
        $sqls[]='insert into `'.$table.'` ('.$sql_insert_columns.') values '.$sql_values.' on duplicate key update '.$sql_update_columns;
    }

    return $sqls;
}

/** 批量更新数据 sql
 * @param string $table         数据表名
 * @param array $insert_columns 数据字段
 * @param array $values         原始数据
 * @param array|string $update_columns  更新字段
 * @param array|string $where_columns   条件字段
 * @return bool|string          返回false(条件不符)，返回string(sql语句)
 */
function batch_update_sql($table='', $insert_columns=[], $values=[], $update_columns=[], $where_columns='id'){
    if(empty($table) || empty($insert_columns) || empty($values) || empty($update_columns) || empty($where_columns)){
        return false;
    }
    // 数据字段必须包含更新字段
    if(is_string($update_columns)){
        if(!in_array($update_columns,$insert_columns)){
            return false;
        }
    }else{
        $common_columns= array_intersect($insert_columns,$update_columns);
        sort($common_columns);
        sort($update_columns);
        if($common_columns != $update_columns){
            return false;
        }
    }
    // 数据字段必须包含条件字段
    if(is_string($where_columns)){
        if(!in_array($where_columns,$insert_columns)){
            return false;
        }
    }else{
        $common_columns= array_intersect($insert_columns,$where_columns);
        sort($common_columns);
        sort($where_columns);
        if($common_columns != $where_columns){
            return false;
        }
    }

    /* ++++++++++ 创建虚拟表 ++++++++++ */
    //创建虚拟表 表名
    $temp_table='`'.$table.'_temp`';
    //创建虚拟表 sql
    $sqls[]='create temporary table '.$temp_table.' like `'.$table.'`';

    /* ++++++++++ 添加数据 ++++++++++ */
    //数据字段
    $sql_insert_columns=[];
    foreach ($insert_columns as $insert_column){
        $sql_insert_columns[]='`'.$insert_column.'`';
    }
    $sql_insert_columns=implode(',',$sql_insert_columns);
    //数据分页
    $num=100;
    $page_values=[];
    foreach ($values as $k=>$value){
        $p=ceil(($k+1)/$num);
        $temp_values=[];
        foreach ($insert_columns as $insert_column){
            $temp=(string)$value[$insert_column] or '';
            $temp_values[]="'".$temp."'";
        }
        $temp_values=implode(',',$temp_values);
        $page_values[$p][]='('.$temp_values.')';
    }

    //插入数据 sql
    foreach($page_values as $p=>$value){
        $sql_values=implode(',',$value);
        $sqls[]='insert into '.$temp_table.' ('.$sql_insert_columns.') values '.$sql_values;
    }


    /* ++++++++++ 批量更新 ++++++++++ */
    //更新字段
    if(is_string($update_columns)){
        $sql_update_columns= '`'.$table.'`.`'.$update_columns.'`='.$temp_table.'.`'.$update_columns.'`';
    }else{
        $sql_update_columns=[];
        foreach ($update_columns as $update_column){
            $sql_update_columns[]= '`'.$table.'`.`'.$update_column.'`='.$temp_table.'.`'.$update_column.'`';
        }
        $sql_update_columns=implode(',',$sql_update_columns);
    }
    //条件字段
    if(is_string($where_columns)){
        $sql_where_columns= '`'.$table.'`.`'.$where_columns.'`='.$temp_table.'.`'.$where_columns.'`';
    }else{
        $sql_where_columns=[];
        foreach ($where_columns as $where_column){
            $sql_where_columns[]= '`'.$table.'`.`'.$where_column.'`='.$temp_table.'.`'.$where_column.'`';
        }
        $sql_where_columns=implode(' and ',$sql_where_columns);
    }
    //更新数据 sql
    $sqls[]='update `'.$table.'`,'.$temp_table.' set '.$sql_update_columns.' where '.$sql_where_columns;

    return $sqls;
}

/**
 * 对象转换成数组
 * @param $obj
 * @return array
 */
function objToArray($obj)
{
    return json_decode(json_encode($obj), true);
}

/** 获取操作控制器和方法
 * @return array
 */
function get_method(){
    $actionNameStr=request()->route()->getActionName();
    $array=explode('\\',$actionNameStr);
    $count=count($array);
    $actionNameStr=$array[$count-1];
    $array=explode('@',$actionNameStr);

    return $array;
}

/** 生成GUID
 * @return string
 */
function create_guid(){
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
    $guid = substr($charid, 6, 2).substr($charid, 4, 2).
        substr($charid, 2, 2).substr($charid, 0, 2).$hyphen
        .substr($charid, 10, 2).substr($charid, 8, 2).$hyphen
        .substr($charid,14, 2).substr($charid,12, 2).$hyphen
        .substr($charid,16, 4).$hyphen.substr($charid,20,12);
    return $guid;
}

/** cURL函数简单封装
 * @param $url
 * @param null $data
 * @return mixed
 */
function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

/** 清除缓存文件夹
 * @param mixed|string $path      文件夹
 * @return bool
 */
function deleteAll($path)
{
    if(!$path){
        return false;
    }
    if (file_exists($path)) {
        $op = dir($path);
        while (false != ($item = $op->read())) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (is_dir($op->path . '/' . $item)) {
                deleteAll($op->path . '/' . $item);
                rmdir($op->path . '/' . $item);
            } else {
                unlink($op->path . '/' . $item);
            }
        }
    }else{
        return false;
    }

    return true;
}

