<?php
namespace app\worker;

use think\worker\Server;

class Ws extends Server
{
    protected $socket = 'websocket://0.0.0.0:2346';
    protected $name   = 'ws-server';

    // onWorkerStart
    public function onWorkerStart($worker)
    {
        echo "start........." . PHP_EOL;
    }

    public function onConnect($connection)
    {
        $connection->send('连接成功');
    }

    public function onMessage($connection, $data)
    {
        $data = json_decode($data, true);
        var_dump($data);
        $connection->send(json_encode($data, JSON_UNESCAPED_UNICODE));
    }

    public function onClose($connection)
    {
        echo "end........." . PHP_EOL;
    }

}
