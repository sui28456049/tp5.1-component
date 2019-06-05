<?php
namespace app\index\controller;

class Index
{
    //  workerman当做http服务器 nginx反代
    //  php think worker
    public function index()
    {
        echo date('Y-m-d H:i:s', time()) . PHP_EOL;
    }

    // php think worker:server
    // websocket 服务器
    public function ws()
    {
        return 'hello,' . $name;
    }
}
