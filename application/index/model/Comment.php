<?php

namespace app\index\model;

use think\Model;

class Comment extends Model
{
    /**
     * 获取评论对应的多态模型
     */
    public function commentable()
    {
        return $this->morphTo('commentable', [
            '1' => 'app\index\model\Blog',
            '2' => 'app\index\model\User',
        ]);
    }
}
