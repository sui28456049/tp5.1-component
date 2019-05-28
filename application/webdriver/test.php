<?php
namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
require_once('../../vendor/autoload.php');


// ################文档#############################
// ################ https://github.com/facebook/php-webdriver/wiki #############################

$host = 'http://localhost:4444/wd/hub';
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);
$driver->get('https://www.baidu.com/');

/* 多元素寻找
 $result = $driver->findElements( WebDriverBy::xpath("//ul[@class='nav-box']/li/a"));

foreach ($result as $v)
{
   echo  $v->getText();
}*/
//$driver->findElement(WebDriverBy::id('kw'))->sendKeys('随某人')->submit();

$driver->wait()->until(
    WebDriverExpectedCondition::visibilityOfElementLocated(
        WebDriverBy::id('kw')
    )
);
$driver->findElement(WebDriverBy::id('kw'))->sendKeys('wwe');
echo 'done!';
$driver->quit();
?>