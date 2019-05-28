<?php
namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
require_once('../../vendor/autoload.php');

$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);
$driver->manage()->timeouts()->implicitlyWait(15);    //隐性设置15秒
$driver->get('https://v.qq.com/x/cover/e7hi6lep1yc51ca.html?vid=h0018p9ihom');

echo $driver->getCurrentURL().PHP_EOL;

//将页面滚动条拖到底部
//因为这个页面默认打开的时候，"评论区"的iframe没有渲染到DOM里，腾讯做的处理是拖动到底部的时候用JS动态渲染，所以我们需要控制浏览器滚动至底部
$js = "window.scrollBy(0,100000000);";
$driver->executeScript($js);
sleep(3);

#再找到其下面的 iframe(id=commentIframe)
$driver->switchTo()->frame("commentIframe");
$str = $driver->getPageSource();

//将获取到的影评数据保存再本地，再测试是否正确。
$myfile = fopen("./video.html", "w") or die("Unable to open file!");
fwrite($myfile, $str);
fclose($myfile);

echo 'done!';

$driver->quit();