<?php
/**
 * Created by PhpStorm.
 * User: likun
 * 获取实验室课表
 * Date: 2017/9/30
 * Time: 上午10:53
 */
header("Content-type: text/html; charset=utf-8");
include "../class/mysql.class.php";

$sysid=$_POST['sysidl'];
$sql = "select sysid,startweek,endweek,week,startsection,endsection,courseid from sys WHERE sysid = '$sysid'";
$result=select($sql);
if ($result instanceof mysqli_result)
{
    $array=array();

    while ( $row=$result->fetch_array())
    {
        $array[$row[6]]=array("sysid"=>$row[0],"startweek"=>$row[1],"endweek"=>$row[2],"week"=>$row[3],"startsection"=>$row[4],"endsection"=>$row[5],"courseid"=>$row[6]);

    }
    $json=json_encode($array);
    print_r($json);

}


