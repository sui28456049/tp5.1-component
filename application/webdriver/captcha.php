<?php
namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
require_once('../../vendor/autoload.php');

const CAPTCHA = './sui.png';   //验证码存放地址

// 截图特定元素 图片的验证码

$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);
$driver->get('http://www.yimuhe.com/');

$driver->manage()->window()->maximize();    //将浏览器最大化

// 不传参数为当前网页图片
$driver->takeScreenshot(CAPTCHA);  //截取当前网页，该网页有我们需要的验证码

$element = $driver->findElement(WebDriverBy::id('vcode_img'));

generateVcodeIMG($element->getLocation(), $element->getSize(),CAPTCHA);

echo 'done!';

//关闭浏览器
$driver->quit();

/**
 * 生成验证码图片
 * @param $location 验证码x,y轴坐标
 * @param $size 验证码的长宽
 */
function generateVcodeIMG($location,$size,$src_img)
{
    $width = $size->getWidth();
    $height = $size->getHeight();
    $x = $location->getX();
    $y = $location->getY();

    $src = imagecreatefrompng($src_img);
    $dst = imagecreatetruecolor($width,$height);
    imagecopyresampled($dst,$src,0,0,$x,$y,$width,$height,$width,$height);
    imagejpeg($dst,$src_img);
    chmod($src_img,0777);
    imagedestroy($src);
    imagedestroy($dst);
}