<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/9/28
 * 微信公众号登录入口
 * 根据openid锁定用户，跳转到申请入口。
 * Time: 上午10:35
 */
$openid=$_GET['openid'];
include "../class/mysql.class.php";
//echo $openid;
$sql="select sname,snumber,sphone,semail from student WHERE openid='$openid'";
$result=select($sql);
if($result->num_rows>0) {

    while ($row=$result->fetch_assoc()){
        //setcookie('sname',$row['sname'],time()+360,'/','.timkj.com');
//        $_SESSION['sname'] = $row['sname'];
//        $_SESSION['snumber'] = $row['snumber'];
//        $_SESSION['sphone'] = $row['sphone'];
//        $_SESSION['semail'] = $row['semail'];

        $url ='apply.php?sname='.$row['sname'].'&snumber='.$row['snumber'].'&sphone='.$row['sphone'].'&semail='.$row['semail'].'&openid='.$openid;
        echo "<script>window.location.href='$url'</script>";
    }
}
else{
    echo "根据openid无法查询到用户，请联系管理员。";
}