<?php
/**
 * 资源文章内容.
 */
namespace app\index\model;
use think\Model;
use traits\model\SoftDelete;

class Contents extends Model
{
    use SoftDelete;
    protected $table = 'rcs_content';
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $deleteTime = 'deleted_at';
    protected $autoWriteTimestamp = true;
    protected $field = true;

    /*------ 评论条数 ------*/
    public function comments()
    {
        return $this->hasMany('Comments','content_id','id');
    }

}