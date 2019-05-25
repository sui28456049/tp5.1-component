<?php
namespace app\index\controller;

use app\index\model\User;
use think\Db;

class Index
{
    public function index()
    {

        // 修改数据
       /* $user = User::get(1);
        $user->name = 'sui 666';
        $res = $user->save();*/

       // 获取器获取数据
        /*$user = User::get(1);
        echo $user->birthday; // 获取器操作
        echo $user->getData('birthday'); //获取原始数据*/

        // 动态获取器,不需要在模型中定义
     /*   $res = User::withAttr('email', function($value, $data) {
            return 'ppp'.$value.'ppp';
        })->select();
        halt($res);*/

        // 修改器
       /* $user = User::get(1);
        $user->birthday = '2029-1-1';
        $user->save();*/
//        halt(User::where('id', '>', 0)->limit(10)->order('id desc')->select());

        // 一对多新增 关联模型
        $user = User::get(1);

       // 新增
        /*$follow_user = [
            'follow_id' => '2',
        ];

       $user->follow()->save($follow_user);*/

        // 查询
      // halt($user->follow()->select());

        // 修改
        // halt($user->follow()->update(['follow_id'=>6],['id'=>2]));

        // 删除
        //halt($user->follow()->delete(true));

        // 关联查询 方法
//        $res = $user->with('follow')->where('status',2)->find();// 查询一个人所有关注
//        $res1 = $user->with(['follow'=> function($query) {
//            $query->where('status','2'); // 查询一个人所有关注并带有限制条件
//        }])->find();

        // 关联统计
//        $res = User::withCount(['msg'=> function($query){
//            $query->where('status',1);
//        }])->find();
//        halt( $res);
        $count = Db::getQueryTimes(true);
        halt($count);

    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
