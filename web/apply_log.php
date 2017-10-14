<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/10/10
 * Time: 下午1:38
 * 申请记录查询显示界面；
 */
include "header.php";

include "../class/mysql.class.php";
$snumber = $_COOKIE['snumber'];
$sql = "SELECT *,GROUP_CONCAT(courseid SEPARATOR ',') from apply,sysinfo WHERE  snumber = $snumber AND apply.sysid = sysinfo.sysid GROUP BY applytime ORDER BY time desc LIMIT 5";
$result=select($sql);



?>
<title>申请记录</title>
</head>
<div class="page__hd">
    <h1 class="page__title">申请记录</h1>
    <p class="page__desc">申请记录查询,目前支持查询最近5条记录。</p>
</div>
<div class="page__bd">
    <article class="weui-article">

<?php
if ($result instanceof mysqli_result)
{
//    $array=array();

    while ( $row=$result->fetch_array())
    {//applyid, sname, sysid, teacher, tphone, applytime, snumber, sphone, courseid, time
//        $array[]=array("applyid"=>$row[0],"sname"=>$row[1],"sysid"=>$row[2],"teacher"=>$row[3],"tphone"=>$row[4],"applytime"=>$row[5],"snumber"=>$row[6],
//            "sphone"=>$row[7],"courseid"=>$row[8],"time"=>$row[9],"sysname"=>$row[11],);

//        echo "<div class='weui-cell'><p>系统序号：$row[0]    预约日期:$row[9]  申请人：$row[1]  申请人学号：$row[6]   指导教师：$row[3]  指导教师联系方式：$row[4]
//                申请人联系方式:$row[7]    申请实验室名称：$row[11] 申请实验室地址：$row[12]$row[13]  申请课程id：$row[8]（未进行转换）
//                实验室负责人：$row[14]     实验室负责人联系方式:$row[15]  实验室负责人联系地址: $row[17] </p>
//                </div>";
        echo "<section>
                    <h3>申请实验室名称：$row[11]</h3>
                    <p>
                       系统序号：$row[0]    预约日期:$row[9]  申请人：$row[1]  申请人学号：$row[6]   指导教师：$row[3]  指导教师联系方式：$row[4]
                申请人联系方式:$row[7]    申请实验室名称：$row[11] 申请实验室地址：$row[12]$row[13]  申请课程id：$row[19]（未进行转换）
                实验室负责人：$row[14]     实验室负责人联系方式:$row[15]  实验室负责人联系地址: $row[17]
                    </p>

                </section>";

    }

}
?>
    </article>
</div>
<a href="main.php" class="weui-btn weui-btn_plain-primary">返回个人中心</a>
