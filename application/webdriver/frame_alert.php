<?php
namespace Facebook\WebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
require_once('../../vendor/autoload.php');

// start Firefox with 5 second timeout
$host = 'http://localhost:4444/wd/hub'; // this is the default
$waitSeconds = 15;  //需等待加载的时间，一般加载时间在0-15秒，如果超过15秒，报错。
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);
$driver->get('https://www.baidu.com/');


$driver->findElement(WebDriverBy::linkText('设置'))->click();

$driver->findElement(WebDriverBy::linkText('搜索设置'))->click();

$warpper = $driver->findElement(WebDriverBy::id('wrapper'));


//由于下拉框是通过点击“搜索设置”按钮触发JS动态生成的DOM，所以这里使用Wait for new element to appear方式，不然直接调用查找元素会报错，说找不到元素
$driver->wait($waitSeconds)->until(
    WebDriverExpectedCondition::visibilityOfElementLocated(
        WebDriverBy::id('nr')
    )
);

$selectDom = $warpper->findElement(WebDriverBy::id('nr'));
$select = new WebDriverSelect($selectDom);
$select->selectByValue(10);

//由于下拉框是通过点击“搜索设置”按钮触发JS动态生成的DOM，所以这里使用Wait for new element to appear方式，不然直接调用查找元素会报错，说找不到元素
$driver->wait($waitSeconds)->until(
    WebDriverExpectedCondition::visibilityOfElementLocated(
        WebDriverBy::linkText('保存设置')
    )
);

$driver->findElement(WebDriverBy::linkText('保存设置'))->click();

sleep(2);

$driver->switchTo()->alert()->accept();

$driver->findElement(WebDriverBy::id("kw"))->sendKeys('wwe');
$driver->findElement(WebDriverBy::id("su"))->click();

echo 'done!';

//关闭浏览器
//$driver->quit();