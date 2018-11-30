<?php
/**
 * Created by PhpStorm.
 * User: danielshen
 * Date: 2018/11/30
 * Time: 上午1:06
 */

$serv = new swoole_server('127.0.0.1',9501);

$serv->set(
    [
        'work_num' => 2,
        'max_request'=> 10000,
    ]
);

//监听链接进入事件 $fd是客户端id
$serv->on('connect',function($serv,$fd){
    echo 'client_id'.$fd.'client Connect';
});

//监听数据接收 $from_id 线程id $data 接收到发送过来的数据
$serv->on('receive',function ($serv,$fd,$from_id,$data){
    $serv->send($fd,'client:'.$fd.'线程'.$from_id."server: ".$data);
});

//监听关闭链接事件
$serv->on('close',function ($serv,$fd){
    echo "client close";
});

//启动服务
$serv->start();