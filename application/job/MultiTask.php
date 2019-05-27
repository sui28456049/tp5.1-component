<?php
namespace app\job;

use think\queue\Job;

// 多任务消息队列
class MultiTask
{
    public function taskA(Job $job,$data)
    {

        $isJobDone = $this->doTaskA($data);

        if ($isJobDone) {
            $job->delete();
            print("Info: TaskA of Job MultiTask has been done and deleted".PHP_EOL);
        }else{
            if ($job->attempts() > 3) {
                $job->delete();
            }
        }
    }

    public function taskB(Job $job,$data)
    {

        $isJobDone = $this->doTaskB($data);

        if ($isJobDone) {
            $job->delete();
            print("Info: TaskB of Job MultiTask has been done and deleted".PHP_EOL);
        }else{
            if ($job->attempts() > 2) {
                $job->release();
            }
        }
    }

    private function doTaskA($data)
    {
        print("Info: doing TaskA of Job MultiTask ".PHP_EOL);
        return true;
    }

    private function doTaskB($data)
    {
        print("Info: doing TaskB of Job MultiTask ".PHP_EOL);
        return true;
    }

    public function failed($data)
    {
        // 任务失败 do something
    }

}
