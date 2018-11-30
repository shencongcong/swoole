<?php
/**
 * Created by PhpStorm.
 * User: danielshen
 * Date: 2018/11/30
 * Time: 上午9:31
 */

$client = swoole_client(SWOOLE_SOCKET_TCP);

if(!$client->connect('127.0.0.1',9501,-1)){
    exit("connect failed {$client->errCode}\n");
}

echo "请输入";
$name = fgets(STDIN);

fwrite(STDOUT, $name);

$client->send($name);
echo $client->recv();

$client->close;