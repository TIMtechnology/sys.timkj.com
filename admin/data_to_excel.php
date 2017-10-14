<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/10/14
 * Time: 上午9:12
 * 申请记录导出excel sq语句需要细化，password目前明文
 */
header('Content-type: text/html; charset=utf-8');
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=test.xls");
include "../class/mysql.class.php";
$sql ="SELECT *,GROUP_CONCAT(courseid SEPARATOR ',') from user,apply,sysinfo WHERE  apply.snumber=user.snumber AND apply.sysid = sysinfo.sysid GROUP BY applytime ORDER BY time desc";
$result=select($sql);
while ($row = mysqli_fetch_array($result)){
    $a=count($row);
    for ($i=0;$i<$a;$i++)
    {
        echo $row[$i]."\t";
    }
    echo "\n";
}
