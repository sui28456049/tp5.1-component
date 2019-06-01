<?php
namespace Facebook\WebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

// 定位操作获测试
require_once('../../vendor/autoload.php');

$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

$driver->manage()->timeouts()->implicitlyWait(15);    //隐性设置15秒
$driver->get('https://www.baidu.com');

// WebDriverBy::id()  通过ID属性定位元素
//$element = $driver->findElement(WebDriverBy::id('kw'));


//WebDriverBy::name() 通过name属性定位元素。如果查找多个，则使用findElements进行定位
//$element = $driver->findElement(WebDriverBy::name('wd'));
//foreach($elements as $elem){    //有时候多个元素时，想找出某个特定元素，可根据attribute或text进行判断过滤
//    echo $elem->getAttribute('type');
//    echo $elem->getText();
//}

// WebDriverBy::tagName()  通过标签进行定位元素。如果查找多个，则使用findElements进行定位

//$element = $driver->findElement(WebDriverBy::tagName('input'));


1. WebDriverBy::id()
2. WebDriverBy::name()
3. WebDriverBy::tagName()
4. WebDriverBy::className()
5. WebDriverBy::linkText()
6. WebDriverBy::partialLinkText()
7. WebDriverBy::xpath()
8. WebDriverBy::cssSelector()
9. 判断定位的元素是否存在


//if(isElementExsit($driver, WebDriverBy::linkText('新闻'))){
//    echo '找到元素啦';
//}else{
//    echo '没有找到元素';
//}
//
///**
// * 判断元素是否存在
// * @param WebDriver $driver
// * @param WebDriverBy $locator
// */
//function isElementExsit($driver,$locator){
//    try {
//        $nextbtn = $driver->findElement($locator);
//        return true;
//    } catch (\Exception $e) {
//        echo 'element is not found!';
//        return false;
//    }
//}