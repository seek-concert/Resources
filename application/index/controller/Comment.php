<?php
/**
 * 留言板.
 */
namespace app\index\controller;
use think\Controller;

class Comment extends Controller
{
    /*======= 留言板 ======*/
    public function index()
    {
         /*------ 页面SEO获取 ------*/
         $seo = get_seo();

         $this->assign('seo',$seo);
		$this->assign('action',request()->controller());
        return view();
    }
}