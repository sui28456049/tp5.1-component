<?php
namespace Facebook\WebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

// 参考 https://blog.csdn.net/johnchiao/article/details/83959089
require_once('../../vendor/autoload.php');

$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);


$driver->manage()->timeouts()->implicitlyWait(15);    //隐性设置15秒
$driver->get('https://www.soyoung.com/');

$driver->findElement(WebDriverBy::linkText('机构'))->click();

get_content($driver); // 得到第一页数据
get_page($driver, 1);

// 跳转页面
function get_page($driver, $page)
{
  for ($i = 0; $i < $page; $i++)
  {
      //将页面滚动条拖到底部 不然悬浮窗口会挡住下一页按钮
      $js = <<<JS
     window.scrollTo(0,1400);
JS;

      $driver->executeScript($js);

      $driver->findElement(WebDriverBy::xpath('//div[@class="pages"]/a[last()]'))->click();

      get_content($driver);
      sleep(10);
  }
}

// 获取内容
function get_content($driver)
{
    $hospital_list = $driver->findElements(WebDriverBy::xpath('//div[@class=\'name\']'));
    foreach ($hospital_list as $v)
    {
        file_put_contents('./list.txt',$v->getText().PHP_EOL,FILE_APPEND);
    }
    return;
}
$driver->quit();