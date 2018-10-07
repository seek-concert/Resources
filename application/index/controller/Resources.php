<?php
/**
 * 资源下载
 */

namespace app\index\controller;
use app\index\model\Ads;
use app\index\model\Contents;
use think\Controller;

class Resources extends Controller
{
    /*======= 资源下载 ======*/
    public function index()
    {

        /*------ 页面SEO获取 ------*/
        $seo = get_seo();

        $this->assign('seo',$seo);
        //最新发布
        $content_title = Contents::field(['id','title'])
            ->limit(10)
            ->order(['release_time'=>'desc'])
            ->select();
        $this->assign('content_title',$content_title);
        //资源信息
        $content_info =  Contents::withCount(['comments'])
            ->where('cover_img','neq','')
            ->order(['release_time'=>'desc'])
            ->paginate(10);
        $this->assign('content_info',$content_info);
        /*------ 友情链接 ------*/

        $href_info = Ads::field(['name','jump_url'])->where(['type'=>2,'status'=>1])->select();

        $this->assign('href_info',$href_info);
        //标识选中
		$this->assign('action',request()->controller());
        return view();
    }

    /*======= 资源详情页 ======*/
    public function resources_detail(){
        $id = input('id');
        if(!$id){
            $this->error('请选择资源!');
        }
        //内容详情
        $content_info = Contents::field(['id','title','label','release_man','click_num','release_time','content'])
            ->where(['id'=>$id])
            ->find();
        $this->assign('content_info',$content_info);

        /*------ 页面SEO获取 ------*/
        $seo['title'] = 'code坞,代码坞,PHP,php学习'.$content_info['title'];
        $seo['keywords'] = 'code坞,代码坞,PHP,php学习'.$content_info['title'];
        $seo['description'] = 'code坞,代码坞,PHP,php学习'.$content_info['title'];
        $this->assign('seo',$seo);
        //标识选中
        $this->assign('action',request()->controller());
        //最新发布
        $content_title = Contents::field(['id','title'])
            ->limit(10)
            ->order(['release_time'=>'desc'])
            ->select();
        $this->assign('content_title',$content_title);
        /*------ 友情链接 ------*/

        $href_info = Ads::field(['name','jump_url'])->where(['type'=>2,'status'=>1])->select();

        $this->assign('href_info',$href_info);
        return view();
    }
}