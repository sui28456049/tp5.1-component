<?php
//僵尸进程 父进程没有及时回收子进程资源

//僵尸进程是指父进程在fork出子进程，而后子进程在结束后，父进程并没有调用wait或者waitpid等完成对其清理善后工作，导致该子进程进程ID、文件描述符等依然保留在系统中，极大浪费了系统资源。所以，僵尸进程是对系统有危害的，而孤儿进程则相对来说没那么严重。在Linux系统中，我们可以通过ps -aux来查看进程，如果有[Z+]标记就是僵尸进程。
// $pid = pcntl_fork();
// if ($pid > 0) {
//     // 下面这个函数可以更改php进程的名称
//     cli_set_process_title('php father process1');
//     // 让主进程休息60秒钟
//     sleep(60);
// } else if (0 == $pid) {
//     cli_set_process_title('php child process1');
//     // 让子进程休息10秒钟，但是进程结束后，父进程不对子进程做任何处理工作，这样这个子进程就会变成僵尸进程
//     sleep(10);
// } else {
//     exit('fork error.' . PHP_EOL);
// }

// zombie.php
foreach (range(1, 10) as $i) {
    $pid = pcntl_fork();
    if ($pid === 0) {
        cli_set_process_title('php zombie process');
        fwrite(STDOUT, "child exit\n");
        exit;
    }
}
sleep(200);
exit;

// ps axu|grep Z |grep -v grep
