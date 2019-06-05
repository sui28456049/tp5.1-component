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

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
