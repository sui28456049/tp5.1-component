<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
       print_r('bbbb');
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
