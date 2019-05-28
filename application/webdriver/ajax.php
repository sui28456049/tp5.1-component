<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/5/28
 * Time: 3:30 PM
 *AJAX分页数据获取
    有时候有些列表页使用的是滚动条到最底部才加载下一页的数据，这个时候就需要用到selenium来操作这样的数据。我们拿letv的分页来做测试。
 */
namespace Facebook\WebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

require_once('../../vendor/autoload.php');

$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);
$driver->manage()->timeouts()->implicitlyWait(15);    //隐性设置15秒
$driver->get('http://list.le.com/listn/c1_t-1_a50071_y-1_s1_lg-1_ph-1_md_o4_d1_p.html');

for ($page = 0; $page < 10; $page++)
{
    ////翻一页
    $js = "window.scrollTo(0,document.body.scrollHeight)";	//滚动至底部
//$js = "window.scrollBy(0,100000000);";  //也可以把值设大一点，达到底部的效果
    $driver->executeScript($js);

// 点击 加载更多
    $driver->wait()->until(
        WebDriverExpectedCondition::visibilityOfElementLocated(
        // 等待元素出现
            WebDriverBy::xpath('//div[contains(@class,"j_load_more")]')
        )
    );

    $more_element =  $driver->findElement(WebDriverBy::xpath('//div[contains(@class,"j_load_more")]'));
    $more_element->click();
    sleep(3);
}

//echo 'sleep...';
//sleep(6);
//
////再翻一页
//$js = "window.scrollTo(0,document.body.scrollHeight)";
//$driver->executeScript($js);
//
//echo 'sleep...';
//sleep(6);
//
////再翻一页
//$js = "window.scrollTo(0,document.body.scrollHeight)";
//$driver->executeScript($js);

echo 'done!';

