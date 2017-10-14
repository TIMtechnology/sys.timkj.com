<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/9/30
 * Time: 上午1:51
 * 根据实验室服务系别获取实验室信息
 */
header("Content-type: text/html; charset=utf-8");
include "../class/mysql.class.php";
$sysleixing=$_POST['leixing'];
$sql = "select sysid,sysname,syslb,sysfjh from sysinfo WHERE sysfwxb = '$sysleixing'";
$result=select($sql);
if ($result instanceof mysqli_result)
{
 $array=array();

    while ( $row=$result->fetch_array())
    {
        $array[]=array("sysid"=>$row[0],"sysname"=>$row[1],"syslb"=>$row[2],"sysfjh"=>$row[3]);

    }
    $json=json_encode($array);
    echo $json;

}
