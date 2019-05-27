<?php
namespace app\index\controller;

use app\index\model\User;
use app\index\model\Blog;
use app\index\model\Content;
use app\index\model\Role;
use app\index\model\Comment;
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


    }

    // 模型关联实例  hasOne 一对一关联
    public function demo()
    {
       //新增
        /*$blog        = new Blog;
        $blog->name  = '测试一对一关联';
        $blog->title = '随某人测试';
        $blog->cate_id = 1;
        $blog->user_id = 1;
        if ($blog->save()) {
            $content       = new Content;
            $content->data = '这是测试内容啊啊啊';
            $blog->content()->save($content);
        }*/

      // 查询
        // 普通关联查询
//        $blog = Blog::get(1);
//        halt($blog->content->data);
//        // 预载入关联查询
//          $blog = Blog::get(1, 'content');
//          echo $blog->content->data;
        // 数据集查询
//        $blogs = Blog::with('content')->select();
//        foreach ($blogs as $blog) {
//            dump($blog->content->data);
//        }
        // [ 关联模型附加数据]
//        $blog = Blog::get(2);
//        $blog->appendRelationAttr('content', 'data');
//        或者在模型中永久绑定 return $this->hasOne('Content')->bind('data');
//        halt( $blog->content);


    // [ 更新 ]
//        $blog = Blog::get(1);
//        $blog->title = "我是修改标题";
//        $blog->save();
//        // 更新关联模型
//        $blog->content->data = '我是修改的内容';
//        $blog->content->save();
//        $blog->together('content')->save();

        // [ 删除 ]
//        $blog = Blog::get(1);
//        $blog->delete();
//        // 删除关联模型
//        $blog->content->delete();

    }

//    模型关联 一对多关联 hasMany和belongsTo
    public  function demo2()
    {
        // 其实一对多关联主要是查询为主，关联写入比起单独模型的操作并没有任何优势，所以建议一对多的关联写入仍然由各个独立模型完成
//        // 可以查询某个用户的博客
//        $user = User::get(1);
//        // 获取用户的所有没删除且cate_id为1的博客
//        dump($user->blogs()->where('cate_id', 1)->whereNull('delete_time')->select());

        // 反过来，如果需要查询博客所属的用户信息
        $blog = Blog::get(1);
        dump($blog->user->name);

    }

    // 多对多关联
    public function demo3()
    {
//        // 增加用户-角色数据
//        // 查询用户
//        $user = User::get(1);
//        // 查询角色
//        $role = Role::getByName('admin');
//        // 增加用户-角色数据
//        halt( $user->roles()->attach($role->id));

//        // 中间表有额外数据需要写入
//        // 查询用户
//        $user = User::get(1);
//        // 查询角色
//        $role = Role::getByName('admin');
//        // 传入中间表的额外属性
//        $user->roles()->attach($role->id, ['add_time' => '2017-1-18']);


//        // 查询用户
//                $user = User::get(1);
//        // 增加用户-角色数据 并同时创建新的角色
//                $user->roles()->attach([
//                    // 添加一个编辑角色
//                    'name' => 'editor',
//                ],['add_time' => '2017-1-31']);


        // 查询用户
        $user = User::get(1);
        // 给用户授权多个角色（根据角色主键）
                $user->roles()->attach([1, 2, 3], ['add_time' => '2017-1-31']);
    }

    // 多态一对多
    public function demo4()
    {
        //例如用户可以评论书和文章，但评论表通常都是同一个数据表的设计。多态一对多关联关系，就是为了满足类似的使用场景而设计。
//        $blog = Blog::get(1);
//
//        foreach ($blog->comments as $comment) {
//            dump($comment);
//        }

        // 站在评论表角度获取blog类型评论
//        Comment 模型的 commentable 关联会返回 Blog 或 User 模型的对象实例，这取决于评论所属模型的类型。
        $comment = Comment::get(3);
        $commentable = $comment->commentable;
        halt($commentable);

    }
}
