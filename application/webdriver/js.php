<?php
namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
require_once('../../vendor/autoload.php');

$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);
$driver->get('https://www.baidu.com/');

$element = $driver->findElement(WebDriverBy::className('s_ipt'));

$js = <<<js
	document.getElementById("kw").style.border = '2px solid red';
	var button = document.getElementById("su");
	button.setAttribute('type','button');
	button.setAttribute('onclick','document.getElementById("kw").style.border = "2px solid blue";alert("随某人");');
js;
$driver->executeScript($js);
echo 'done!';

//关闭浏览器
//$driver->quit();

?>