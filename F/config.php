<?php
 $hostname="localhost"; //mysql地址
 $basename="root"; //mysql用户名
 $basepass="root"; //mysql密码
 $database="foodie"; //mysql数据库名称

 $conn=mysql_connect($hostname,$basename,$basepass)or die("error!"); //连接mysql              
 mysql_select_db($database,$conn) or die('Could not connect to db'); //选择mysql数据库
 mysql_query("set names 'utf8'");//mysql编码
?>