<?php

namespace app\index\model;

use think\Model;

class Follow extends Model
{
    // 开启时间字段自动写入
    protected $autoWriteTimestamp = true;
    // 定义时间字段名
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';


}