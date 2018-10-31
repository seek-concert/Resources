<?php
/*
|--------------------------------------------------------------------------
| 资源文章管理
|--------------------------------------------------------------------------
*/
namespace app\admin\controller;


use app\admin\model\Contents;

class Content extends Base
{
    /* ========== 初始化 ========== */
    public function _initialize()
    {
        parent::_initialize();
    }

    /* ========== 文章列表 ========== */
    public function index(){
        if(request()->isAjax()){

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['title'] = ['like', '%' . $param['searchText'] . '%'];
            }

            $selectResult = Contents::where($where)->limit($offset, $limit)->select();


            // 拼装参数
            foreach($selectResult as $key=>$vo){

                $selectResult[$key]['operate'] = showOperate(makeButton('content',$vo['id']));
            }

            $return['total'] = Contents::where($where)->count();  //总数据
            $return['rows'] = $selectResult;

            return json($return);
        }
        return view();
    }

    /* ============ 添加资源文章 ============== */
    public function add(){
        if(request()->isPost()){
            $param = input('post.');
            $rule = [
                ['title', 'require', '请填写资源文章标题!'],
                ['profile', 'require', '请填写资源文章简介!'],
                ['content', 'require', '请填写资源文章内容!'],
                ['label', 'require', '请填写资源文章关键字!'],
                ['release_man', 'require', '请填写资源文章发布人!']
            ];
            $result = $this->validate($param, $rule);
            if (true !== $result) {
                return $this->error($result);
            }

            $param['release_time'] = date('Y-m-d');
            $param['label'] = implode(' ',explode(',',$param['label']));
            $model = new Contents();
            $rs =  $model->save($param);
            if($rs){
                return $this->success('添加成功!',url('content/index'));
            }else{
                return $this->error('添加失败!');
            }
        }

        return view();
    }


    /* ============ 修改资源文章 ============== */
    public function edit(){
        $param = input('');
        if(!$param['id']){
            return $this->error('请选择资源文章！');
        }
        if(request()->isPost()){
            $rule = [
                ['title', 'require', '请填写资源文章标题!'],
                ['profile', 'require', '请填写资源文章简介!'],
                ['content', 'require', '请填写资源文章内容!'],
                ['label', 'require', '请填写资源文章关键字!'],
                ['release_man', 'require', '请填写资源文章发布人!']
            ];
            $result = $this->validate($param, $rule);
            if (true !== $result) {
                return $this->error($result);
            }

            $model = new Contents();
            $param['label'] = implode(' ',explode(',',$param['label']));
            $rs =  $model->save($param,['id'=>$param['id']]);
            if($rs){
                return $this->success('修改成功!',url('content/index'));
            }else{
                return $this->error('修改失败!');
            }
        }

        $content = Contents::where(['id'=>$param['id']])->find();
        $this->assign([
            'id'=>$param['id'],
            'infos' => $content
        ]);

        return view();
    }

    /* ============ 删除资源文章 ============== */
    public function del(){
        $param = input('');
        if(!$param['id']){
            return $this->error('请选择资源文章！');
        }
        $rs = Contents::where(['id'=>$param['id']])->delete();
        if($rs){
            return $this->success('删除成功!');
        }else{
            return $this->error('删除失败!');
        }
    }

}