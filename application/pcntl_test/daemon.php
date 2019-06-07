<?php
$pid = pcntl_fork();

if ($pid > 0) {
    // parent process
    exit(0);
} elseif ($pid < 0) {
    exit(' fork error. ');
}

// 将当前子进程提升会会话组组长 这是至关重要的一步
cli_set_process_title('daemon process');

if (!posix_setsid()) {
    exit(' setsid error. ');
}

// 二次fork
$pid = pcntl_fork();

if ($pid < 0) {
    exit(' fork error. ');
} else if ($pid > 0) {
    exit(' parent process. ');
}

// 真正业务逻辑
for ($i = 0; $i < 10; $i++) {
    sleep(1);
    file_put_contents('daemon.log', $i . PHP_EOL, FILE_APPEND);
}
