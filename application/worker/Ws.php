<?php
namespace app\worker;

use think\worker\Server;
use Workerman\Lib\Timer;

class Ws extends Server
{
    protected $socket = 'websocket://0.0.0.0:2346';
    protected $name   = 'ws-server';

    // onWorkerStart
    public function onWorkerStart($worker)
    {
        // 定时，每10秒一次
        Timer::add(10, function () use ($worker) {
            // 遍历当前进程所有的客户端连接，发送当前服务器的时间
            foreach ($worker->connections as $connection) {
                $connection->send(time());
            }
        });
        echo "start........." . PHP_EOL;
    }

    public function onConnect($connection)
    {
        $connection->send('连接成功');
    }

    public function onMessage($connection, $data)
    {
        $data = json_decode($data, true);
        // var_dump($data);
        $connection->send(json_encode($data, JSON_UNESCAPED_UNICODE));
    }

    public function onClose($connection)
    {
        echo "end........." . PHP_EOL;
    }

}
