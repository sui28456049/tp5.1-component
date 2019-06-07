<?php

// 真正业务逻辑
for ($i = 0; $i < 150; $i++) {
    sleep(1);
    file_put_contents('task.log', $i . PHP_EOL, FILE_APPEND);
}
