<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/5/28
 * Time: 3:30 PM
 *代理设置
有时候我们需要修改浏览器的一些User Agent信息或代理IP，从而达到更好的兼容性测试。这里我们就用一个在线UserAgent分析工具进行测试。
 */
namespace Facebook\WebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
require_once('../../vendor/autoload.php');


$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$useragent = 'Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1';
$options = new ChromeOptions();
$options->addArguments(["user-agent={$useragent}"]);
$capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

$driver = RemoteWebDriver::create($host, $capabilities, 5000);
$driver->manage()->timeouts()->implicitlyWait(15);    //隐性设置15秒
$driver->get('http://www.atool.org/useragent.php');
var_dump($capabilities->getCapability(ChromeOptions::CAPABILITY));
echo 'done!';

?>