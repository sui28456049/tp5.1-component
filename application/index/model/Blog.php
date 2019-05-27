<?php

namespace app\index\model;

use think\Model;
use think\model\concern\SoftDelete;

class Blog extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';


    /**
     * 获取博客所属的用户
     */
    public function user()
    {
        return $this->belongsTo('User','user_id','id');
    }

    /**
     * 获取博客的内容
     */
    public function content()
    {
        return $this->hasOne('Content','blog_id','id');
        // 默认一对一关联查询也是使用2次查询，如果希望获取更好的性能，可以修改关联定义为：
        // return $this->hasOne('Content','blog_id','id')->setEagerlyType(0);
        //修改后，关联查询从原来默认的IN查询改为JOIN查询，可以减少一次查询，但有一个地方必须注意，指定的关联表字段field方法必须改为withField方法。
    }

    /**
     * 获取所有博客所属的分类
     */
    public function cate()
    {
        return $this->belongsTo('Cate');
    }

    /**
     * 获取所有针对文章的评论
     */
    public function comments()
    {
        // 对应的是博客文档的   第三个参数为指定 多态类型的 1 或 2 或者用文字
        return $this->morphMany('Comment', 'commentable','1');
        // 如果是博客文章的评论的评论 可以放一个表,以类型区分,2 为评论别人的
        //         return $this->morphMany('Comment', 'commentable','2');
    }
}
