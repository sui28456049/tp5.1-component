<?php
namespace app\worker\controller;

use think\Controller;

class Index extends controller
{
    public function index()
    {
        $this->assign([
            'uid' => mt_rand(100, 999),
        ]);

        return $this->fetch();
    }
}
