<?php
include('Requests.php');

//配置KEY和SECRET
define( "KEY" , '' );
define( "SECRET" , '' );

$sutui=new sutui(KEY,SECRET);

//发文字消息
$sutui->notify(1000,'text','hello');

//发图文消息
$news[]=array('title'=>'hello','description'=>'hello world','url'=>'','picurl'=>'');
$sutui->notify(1000,'news',$news);

//创建远程命令
$sutui->create_command(1000,'command','http://XXX.php','hello');

//更多用法请参见:
//官方接口文档：http://mp.weixin.qq.com/s?__biz=MjM5NjAwMjMwMA==&mid=200880875&idx=1&sn=f6b59bb9f62237c72e29084d0b4d08b3
//速推开发指南：http://mp.weixin.qq.com/s?__biz=MjM5NjAwMjMwMA==&mid=200864258&idx=1&sn=3ace07c044efa933dabeca0cbee0d0a6