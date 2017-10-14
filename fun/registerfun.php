<?php
/**
 * Created by PhpStorm.
 * User: likun
 * 注册写入方法，未进行限制。
 * 注册数据在jquery限制
 * Date: 2017/9/27
 * Time: 下午2:21
 */
require ("../class/mysql.class.php");
$snumber=$_POST['snumber'];
$spassword=$_POST['spassword'];
$sphone = $_POST['sphone'];
$sname = $_POST['sname'];
$sxueyuan=$_POST['sxueyuan'];
$syuanxi=$_POST['syuanxi'];//snumber, sname, spassword, sphone, isadmin, isteacher, sxueyuan, syuanxi
$sql="insert into user(snumber,spassword,sname,sphone,sxueyuan,syuanxi) VALUES ('$snumber','$spassword','$sname',$sphone,'$sxueyuan','$syuanxi')";
$result=insert($sql);
if ($result==true)
    echo 1;
else echo 0;



