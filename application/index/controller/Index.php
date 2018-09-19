<?php

/**

 * 首页

 */

namespace app\index\controller;

use app\index\model\Ads;

use app\index\model\Comments;

use app\index\model\Contents;



class Index extends Base

{

    /* ========== 初始化 ========== */

    public function _initialize()

    {

        parent::_initialize();

    }



    /*======= 首页 ======*/

    public function index()

    {
         /*------ 页面SEO获取 ------*/
        $seo = get_seo();

        $this->assign('seo',$seo);

        /*------ 首页banner图 ------*/

        $banner_info = Ads::field(['img_url'])->where(['type'=>1,'status'=>1])->select();

        $this->assign('banner_info',$banner_info);



        /*------ 文章信息 ------*/

        //博主置顶

        $content_top = Contents::field(['title','content'])->where(['is_top'=>1])->find();

        $this->assign('content_top',$content_top);

        //最新发布

        $content_info = Contents::withCount(['comments'])

            ->where(['is_top'=>0])

            ->limit(10)

            ->order(['release_time'=>'desc'])

            ->select();

        $this->assign('content_info',$content_info);



        /*------ 网站配置【站点公告-微信公众号】 ------*/

        $this->assign('config_info',$this->config_info);



        /*------ 热门标签 ------*/

        $content_label = Contents::field(['label'])

            ->order(['release_time'=>'desc'])

            ->select();



        $label_arr = [];

        foreach($content_label as $k=>$v){

            $label= explode(' ',$v['label']);

            foreach ($label as $key=>$val){

                $label_arr[] = $val;

            }

        }

        $label_arr =  array_unique($label_arr);

        $this->assign('label_arr',$label_arr);

        /*------ 友情链接 ------*/

        $href_info = Ads::field(['name','jump_url'])->where(['type'=>2,'status'=>1])->select();

        $this->assign('href_info',$href_info);



        //标识选中

        $this->assign('action',request()->controller());

        return view();

    }

}

