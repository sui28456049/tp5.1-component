<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/5/28
 * Time: 4:52 PM
 */

require_once('../../vendor/autoload.php');
//use PhantomInstaller\PhantomBinary;
use JonnyW\PhantomJs\Client;

$bin = PhantomInstaller\PhantomBinary::BIN;

$client = Client::getInstance();
$client->getEngine()->setPath($bin);

$client->getEngine()->addOption('--load-images=true');
$client->getEngine()->addOption('--ignore-ssl-errors=true');

$request  = $client->getMessageFactory()->createRequest('http://www.soyoung.com');
$response = $client->getMessageFactory()->createResponse();

$client->send($request, $response);

var_dump($response->getContent());
