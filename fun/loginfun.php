<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/9/28
 * 登录系统函数，设置cookie
 * Time: 上午1:25
 */
require ("../class/mysql.class.php");

$snumber=$_POST['snumber'];
$spassword=$_POST['spassword'];

$sql="select snumber,sname,sphone,sxueyuan,syuanxi from user WHERE snumber='$snumber' AND spassword='$spassword'";

$result=select($sql);
if($result->num_rows>0) {

    while ($row=$result->fetch_assoc()){
        setcookie('sname',$row['sname'],time()+360,'/','sys.timkj.com');
        setcookie('snumber',$row['snumber'],time()+360,'/','sys.timkj.com');
        setcookie('sphone',$row['sphone'],time()+360,'/','sys.timkj.com');
        setcookie('sxueyuan',$row['sxueyuan'],time()+360,'/','sys.timkj.com');
        setcookie('syuanxi',$row['syuanxi'],time()+360,'/','sys.timkj.com');
        $data=array('sname'=>$row['sname'],'snumber'=>$row['snumber'],'sphone'=>$row['sphone']);

        echo json_encode($data);
    }
}
else{
    echo 0;
}