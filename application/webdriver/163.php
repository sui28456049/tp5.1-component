<?php
namespace Facebook\WebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

// 参考 https://blog.csdn.net/johnchiao/article/details/83959089
require_once('../../vendor/autoload.php');

$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

// 由于网易云音乐评论在frame里,切换frame
$driver->manage()->timeouts()->implicitlyWait(15);    //隐性设置15秒
$driver->get('https://music.163.com/#/song?id=168091');


//将页面滚动条拖到底部
//因为这个页面默认打开的时候，"评论区"的iframe没有渲染到DOM里，网易做的处理是拖动到底部的时候用JS动态渲染，所以我们需要控制浏览器滚动至底部
$js = "window.scrollTo(0,1000000)";
$driver->executeScript($js);
sleep(3);

#再找到其下面的 iframe(id=g_iframe)
$driver->switchTo()->frame('g_iframe');
$next_page_button = $driver->findElement(WebDriverBy::partialLinkText('下一页'));
$next_page_button->click();
//$html = $driver->getPageSource(); //获取评论页面
//file_put_contents('./comments.html',$html);

//$elements = $driver->findElements(WebDriverBy::xpath('//div/div[2]/div[1]/div[1]'));
//
//foreach($elements as $v)
//{
//    var_dump($v->getText());
//}





// 下一页
function next_page_req($driver,$page =1)
{
    for($i = 0; $i < $page; $i++)
    {
        $next_page_button = $driver->findElement(WebDriverBy::linkText('下一页'));
        $next_page_button->click();

        $elements = $driver->findElements(WebDriverBy::xpath('//div/div[2]/div[1]/div[1]'));

        foreach($elements as $v)
        {
            var_dump($v->getText());
        }
    }
}

//$driver->quit();
