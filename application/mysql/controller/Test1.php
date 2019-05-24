<?php

namespace app\mysql\controller;

use think\Controller;
use think\Request;
use think\Db;

//Db 高级查询
class Test1 extends Controller
{
    public function index()
    {
        // 获取查询 sql 语句 不会进行实际的查询   返回SQL字符串
   /*     $res = Db::table('data')
            ->fetchSql(true)
            ->where('id',1)
            ->find();

        $res = Db::table('data')
            ->where('id',1)
            ->select(false);*/

        // 返回PDOStatement对象
      /*  $pdo = Db::table('data')
            ->field('name')
            ->getPdo();
        $result = $pdo->fetchColumn();
        dump($result);*/

        // 使用SQL函数或运算
        /*$res = Db::table('data')
            ->field('COUNT(*)')
            ->find();*/
     /*   $res = Db::table('data')
            ->where('id',1)
            ->update([
                'score' => Db::raw('score+1'),
            ]);*/

        // 聚合查询
        /*$count = Db::table('data')
            ->where('id','>','0')
            ->min('score'); // min/sum/count/avg
        halt($count);*/

        // 快捷查询
        // 多个字段之间用|分割表示OR查询，用&分割表示AND查询
     /*   $res = Db::table('user')
                    ->where('name|title', 'like', 'thinkphp%')
                    ->where('create_time&update_time', '>', 0)
                    ->find();*/
    //     生成 sql 语句:`SELECT * FROM `user` WHERE ( `name` LIKE 'thinkphp%' OR `title` LIKE 'thinkphp%' ) AND ( `create_time` > 0 AND `update_time` > 0 ) LIMIT 1`

        //  动态查询 user中有email和nick_name字段
            // 根据邮箱查询用户信息
           /* $user = Db::table('user')
                ->getByEmail('thinkphp@qq.com');
            // 根据昵称查询用户信息
            $user = Db::table('user')
                ->field('id,name,nick_name,email')
                ->getByNickName('流年');
            // 根据邮箱查询用户的昵称
            $nickname = Db::table('user')
                ->getFieldByEmail('thinkphp@qq.com', 'nick_name');
            // 根据昵称查询用户邮箱
            $email = Db::table('user')
                ->getFieldByNickName('流年', 'email');*/

           // 时间查询
        // 查询创建时间大于2016-1-1的数据
      /*  $result = Db::name('data')
            ->whereTime('create_time', '>', '2016-1-1')
            ->select();
        dump($result);

        // 查询本周添加的数据
        $result = Db::name('data')
            ->whereTime('create_time', '>', 'this week')
            ->select();
        dump($result);

        // 查询最近两天添加的数据
        $result = Db::name('data')
            ->whereTime('create_time', '>', '-2 days')
            ->select();
        dump($result);

        // 查询创建时间在2016-1-1~2016-7-1的数据
        $result = Db::name('data')
            ->whereTime('create_time', 'between', ['2016-1-1', '2016-7-1'])
            ->select();
        dump($result)
        // 获取今天的数据
        $result = Db::name('data')
            ->whereTime('create_time', 'today')
            ->select();
        dump($result);

        // 获取昨天的数据
        $result = Db::name('data')
            ->whereTime('create_time', 'yesterday')
            ->select();
        dump($result);

        // 获取本周的数据
        $result = Db::name('data')
            ->whereTime('create_time', 'week')
            ->select();
        dump($result);

        // 获取上周的数据
        $result = Db::name('data')
            ->whereTime('create_time', 'last week')
            ->select();
        dump($result);
        */

        // 子查询
       /* $subQuery = Db::table('user')
            ->field('id,name')
            ->where('id', '>', 10)
            ->buildSql();

        //然后使用子查询构造新的查询
        Db::table($subQuery . ' a')
            ->where('a.name', 'like', 'thinkphp')
            ->order('id', 'desc')
            ->select();*/

    }
}
