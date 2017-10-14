<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/9/27
 * 用户注册入口，必须在微信注册。暂时还未做限制微信外无法访问。
 * 根据openid判断是否注册过，已注册跳转，未注册进行注册。该功能在柳老师正式环境中不使用。
 * 本页还存在正则表达式问题。
 * Time: 下午2:14
 */
include 'header.php';
require "../class/mysql.class.php";
//$openid=$_GET['openid'];
//$sql = "select openid from student WHERE openid='$openid'";
//$result=select($sql);
//if ($result->num_rows>0)
//{
//    $url = "wxlogin.php?openid=".$openid;
//    echo "<script>window.location.href='$url'</script>";
//    exit();
//}



?>

    <title>注册-沈阳师范大学实验室管理系统</title>
<script src="../js/jquery.js"></script>
</head>
<body>
<div class="container" id="container">
    <div class="page__hd">
        <h1 class="page__title">注册</h1>
        <p class="page__desc">欢迎注册沈阳师范大学实验室管理系统</p>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">校园卡号</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="snumber" type="number" pattern="[0-9]*" placeholder="请输入校园卡号">
        </div>
    </div>

    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="spassword" type="password"  placeholder="请输入密码">
        </div>
    </div>

    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="sname" type="text"  placeholder="请输入姓名">
        </div>
    </div>

    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="sphone" type="number" pattern="^\d{11}$" placeholder="请输入手机号">
        </div>
    </div>

    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">所属学院</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="sxueyuan" type="text" placeholder="请输入所属学院">
        </div>
    </div>

    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">所属院系</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="syuanxi" type="text" placeholder="请输入所属院系">
        </div>
    </div>
    <input hidden value="<?php echo $openid?>" id="openid">
    <a onclick='register()' class="weui-btn weui-btn_plain-primary">注册</a>

</div>

</body>
<script>
        function register() {
            var snumber = $("#snumber").val();
            var spassword = $("#spassword").val();
            var sphone = $("#sphone").val();
            var sname = $("#sname").val();
            var sxueyuan = $("#sxueyuan").val();
            var syuanxi = $("#syuanxi").val();

            $.post("../fun/registerfun.php",{snumber:snumber,spassword:spassword,sname:sname,sphone:sphone,sxueyuan:sxueyuan,syuanxi:syuanxi},function (result) {

                    console.log(result);
                    if(result==1){
                        location.href="./register_success.html"
                    }else location.href="./fail.html"

            })
        }

</script>


