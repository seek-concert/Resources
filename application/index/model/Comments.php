<?php
/**
 * 资源文章评论记录
 */
namespace app\index\model;
use think\Model;
use traits\model\SoftDelete;

class Comments extends Model
{
    use SoftDelete;
    protected $table = 'rcs_comment';
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $deleteTime = 'deleted_at';
    protected $autoWriteTimestamp = true;
    protected $field = true;
    protected $type = [
        'comment_time'  =>  'timestamp'
    ];
}