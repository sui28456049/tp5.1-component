<?php

namespace app\index\model;

use think\Model;

class User extends Model
{

    // 开启时间字段自动写入
    protected $autoWriteTimestamp = true;
    // 定义时间字段名
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';


    /**
     * 关联模型
     */
    public function follow()
    {
       return  $this->hasMany('follow','user_id','id');
    }

    /**
     * 获取用户消息
     * @return \think\model\relation\HasMany
     */
    public function msg()
    {
        return  $this->hasMany('msg','user_id','id');
    }
    /*
     * 这是获取器
     * 数据库字段 birthday
     */
    public function getBirthdayAttr($value)
    {
        return date('Y-m-d', $value);
    }

    /**
     *获取修改时间
     * @param $value
     * @return false|string
     */
    protected function getCreateTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    /**
     * 获取器方法的第二个参数表示当前数据对象的所有数据，数据表并不存在user_title字段
     * @param $value
     * @param $data
     * @return string
     */
    protected function getUserTitleAttr($value,$data)
    {
        return $data['name'] . ':' . $data['id'];
    }

    /**
     * 修改时间戳
     * @param $value
     * @return false|int
     */
    protected function setBirthdayAttr($value)
    {
        return strtotime($value);
    }

    /**
     * 如果你需要在修改器中使用其它属性的值
     * @param $value
     * @param $data
     * @return string
     */
    protected function setUserTokenAttr($value, $data)
    {
        return md5($data['name'] . $data['birthday']);
    }


    //////////////测试关联模型需要
    /**
     * 获取用户所属的角色信息
     */
    public function roles()
    {
        return $this->belongsToMany('Role', 'auth','role_id','user_id');
    }

    /**
     * 获取用户发表的博客信息
     */
    public function blogs()
    {
        return $this->hasMany('Blog','user_id','id');
    }

    /**
     * 获取所有针对用户的评论
     */
    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }
}
