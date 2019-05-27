<?php
namespace app\index\controller;
use think\Queue;

class Index
{
    // 测试队列
    // 创建消息队列|消息的创建与推送 下单成功后发送邮件
    public function send()
    {
        // 1.当前任务将由哪个类来负责处理。
        //   当轮到该任务时，系统将生成一个该类的实例，并调用其 fire 方法
        $jobHandlerClassName  = 'app\job\Job1';

        // 2.当前任务归属的队列名称，如果为新队列，会自动创建
        $jobQueueName = "sendEmailQueue";

        // 3.当前任务所需的业务数据 . 不能为 resource 类型，其他类型最终将转化为json形式的字符串
        $task_data = ['uid'=>mt_rand(100,999),'email'=>'28456049@qq.com'];

        // 4.将该任务推送到消息队列，等待对应的消费者去执行
        $isPushed = Queue::push( $jobHandlerClassName , $task_data , $jobQueueName );

        // database 驱动时，返回值为 1|false  ;   redis 驱动时，返回值为 随机字符串|false
        if( $isPushed !== false ){
            echo date('Y-m-d H:i:s') . " a new Hello Job is Pushed to the MQ".PHP_EOL;
        }else{
            echo 'Oops, something went wrong.';
        }


        // 运行  php think queue:work --queue sendEmailQueue
        // 运行并且监听 php think queue:listen --queue sendEmailQueue


        //注意: 在这个例子当中，我们是手动指定的 $jobHandlerClassName ，更合理的做法是先定义好消息名称与消费者类名的映射关系，然后由某个可以获取该映射关系的类来推送这个消息。这样，生产者只需要知道消息的名称，而无需指定哪个消费者类来处理。
//        $task_list_map = [
//            'send_email' => 'app\job\job1',
//            'order_revise'=> 'app\job\job2',
//        ];
    }


    // 多种任务分发
    public function MultiTask()
    {
        $taskType = $_GET['taskType'];

        switch ($taskType) {
            case 'taskA':
                $jobHandlerClassName  = 'app\job\MultiTask@taskA';
                $jobDataArr = ['a'	=> '1'];
                $jobQueueName = "multiTaskJobQueue";
                break;
            case 'taskB':
                $jobHandlerClassName  = 'app\job\MultiTask@taskB';
                $jobDataArr = ['b'	=> '2'];
                $jobQueueName = "multiTaskJobQueue";
                break;
            default:
                break;
        }

        $isPushed = Queue::push($jobHandlerClassName, $jobDataArr, $jobQueueName);

        if ($isPushed !== false)
        {
            echo("the $taskType of MultiTask Job has been Pushed to ".$jobQueueName.PHP_EOL);
        }else{
           echo ("push a new $taskType of MultiTask Job Failed!");
        }

    }



}
