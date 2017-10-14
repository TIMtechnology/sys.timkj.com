<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/10/4
 * 写入申请记录数据库
 * Time: 下午9:38
 */
include "../class/mysql.class.php";
$teacher = $_POST['teacher'];
$tphone = $_POST['tphone'];
$array = $_POST['array'];
$sname = $_POST['sname'];
$sphone = $_POST['sphone'];
$snumber = $_POST['snumber'];
$time = $_POST['time'];
$sysid = $_POST['sysid'];

$json = json_decode($array);

for ($i=0;$i<count($json);$i++)
{
 $sql="INSERT INTO apply (sname, sysid, courseid, teacher, tphone,snumber,sphone,time) VALUES ('$sname','$sysid','$json[$i]','$teacher','$tphone','$snumber','$sphone','$time')";
 $result = insert($sql);
    if ($result==true)
        echo 1;
    else echo 0;
}
