<?php
/**
 * 关于我们.
 */
namespace app\index\controller;
use think\Controller;

class About extends Controller
{
    /*======= 关于我们 ======*/
    public function index()
    {
        /*------ 页面SEO获取 ------*/
        $seo = get_seo();

        $this->assign('seo',$seo);
        
		$this->assign('action',request()->controller());
        return view();
    }
}