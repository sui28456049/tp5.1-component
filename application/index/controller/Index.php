<?php
namespace app\index\controller;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class Index
{
    // 命令行运行  php public/index.php index/index/index
    public function index()
    {
        // start Firefox with 5 second timeout
        $waitSeconds = 15;  //需等待加载的时间，一般加载时间在0-15秒，如果超过15秒，报错。
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        //这里使用的是chrome浏览器进行测试，需到http://www.seleniumhq.org/download/上下载对应的浏览器测试插件
        //我这里下载的是win32 Google Chrome Driver 2.25版：https://chromedriver.storage.googleapis.com/index.html?path=2.25/
        $capabilities = DesiredCapabilities::chrome();

        $driver = RemoteWebDriver::create($host, $capabilities, 5000);
        // navigate to 'http://docs.seleniumhq.org/'
        $driver->get('https://www.baidu.com/');


        $element = $driver->findElement(WebDriverBy::xpath("//input[@id='su']"));
        dump($element);
//        $driver->close();

    }


    // AJAX分页数据获取
    public function ajax()
    {
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $capabilities = DesiredCapabilities::chrome();
        $driver = RemoteWebDriver::create($host, $capabilities, 5000);
        $driver->manage()->timeouts()->implicitlyWait(15);    //隐性设置15秒
        $driver->get('http://list.le.com/listn/c1_t-1_a50071_y-1_s1_lg-1_ph-1_md_o4_d1_p.html');

        //翻一页
        $js = "window.scrollTo(0,document.body.scrollHeight)";	//滚动至底部
        //$js = "window.scrollBy(0,100000000);";  //也可以把值设大一点，达到底部的效果
        $driver->executeScript($js);

        echo 'sleep...';
        sleep(6);

        //再翻一页
        $js = "window.scrollTo(0,document.body.scrollHeight)";
        $driver->executeScript($js);

        echo 'sleep...';
        sleep(6);

        //再翻一页
        $js = "window.scrollTo(0,document.body.scrollHeight)";
        $driver->executeScript($js);

        echo 'done!';

        //关闭浏览器
        $driver->quit();
    }

}

