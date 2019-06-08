<?php

// 说明子进程拥有父进程的数据副本，而并不是共享：

$number = 1;
$pid    = pcntl_fork();

if ($pid < 0) {
    exit('gg');
} elseif ($pid > 0) {
    $number += 1;
    echo 'Father---' . $number . PHP_EOL; //2
} elseif ($pid == 0) {
    $number += 5;
    echo 'Child---' . $number . PHP_EOL; //6
    exit;
}
