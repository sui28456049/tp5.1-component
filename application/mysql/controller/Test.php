<?php

namespace app\mysql\controller;

use think\console\Table;
use think\Controller;
use think\Request;
use think\Db;

// 测试 Db基础操作
class Test extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //*** 单条插入
       /*   $res = Db::table('data')
                ->insert(['user_id' => '1', 'name' => 'thinkphp']);*/

        //*** 插入多个记录  以insert和insertAll方法的返回值也是影响（新增）的记录数，并不会返回主键值。
     /*   $res = Db::table('data')
                    ->insertAll([
                        ['user_id' => 2, 'name' => 'thinkphp'],
                        ['user_id' => 3, 'name' => 'topthink'],
                        ['user_id' => 3, 'name' => 'topthink1'],
                    ]);

        // 获取上次写入的自增Id
        $id = Db::getLastInsID();*/

     // *** 获取自增 id
//        $id = Db::table('data')
//            ->insertGetId(['user_id'=>1, 'name' => 'kancloud']);

        // 不抛出异常
     /*   $id = Db::table('data')
            ->strict(false)
            ->insertGetId([
                'name' => 'kancloud',
                'user_id'	=>	'1',
                'test' 	=> '这条数据被写入,test 字段没有不被写入',
            ]);*/
    }

    public  function update()
    {
        //基础操作
       /*$res = Db::table('data')
                ->where('id', 8)
                ->update(['name' => "sui"]);*/

       // 更新限制字段
    /*   $res = Db::table('data')
                    ->field(['name'])
                    ->where('id', 8)
                    ->update([
                        'name' => '22',
                        'user_id' => '999' //这个字段的数据会被忽略
                    ]);*/

        // 更新一个字段
      /*  $res = Db::table('data')
                    ->where('id', 8)
                    ->setField('name','111');*/
       // 递增递减一个字段
     /*     $res = Db::table('data')
                    ->where('id', 1)
                    ->setInc('user_id', 5);

          $res = Db::table('data')
                    ->where('id', 1)
                    ->setDec('user_id', 2);*/
//        halt($res);

    }

    public function select()
    {
        // 查询单个数据
       /* $data = Db::table('data')->where('id', 8)->find();
        halt($data);*/

       // 简化写法
       /* $data =Db::table('data')->find(8);
        halt($data);*/

       // 查询多个数据
       /* $list = Db::table('data')
            ->where('id','in', [1,5,8])
            ->select();*/

       // 获取记录的某个字段值
       /* $res = Db::table('data')
            ->where('id', 1)
            ->value('name');*/

       // 记录某个列的值
       /* $res = Db::table('data')
                ->where('user_id',1)
                ->column('name','id'); // 第二个参数为索引
        halt($res);*/

       //
    }

    // 删除操作
    public function delete()
    {
        // 基本操作
        /*$res =Db::name('data')
            ->where('id',6)
            ->delete();
        halt($res);*/

        // 简化操作
        /*Db::name('data')
            ->delete(2);*/

        // 删除多条数据
      /*  Db::name('data')
            ->delete([1, 5, 8]);*/

      // 删除全部数据
        $res = Db::name('data')
                ->delete(true);
        halt($res);

    }

    public function pdo()
    {
        // 对数据表的CURD操作，除了select和存储过程调用使用query方法之外，其它的操作都使用execute方法
//        $res = Db::execute('insert into data (id, user_id, name) values (1, 1, "sui")');
//        halt($res);

        // 查询
      /* $res = Db::query('select name from data where id = 1');
       halt($res);*/

        // 使用参数绑定
        $res = Db::execute('insert into data (user_id, name) values (?,?)',[2,'sui2']);
        $res1 = Db::query('select * from data where id=?',[1]);
        halt($res1);

    }

}
