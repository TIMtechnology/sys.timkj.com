<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/9/28
 * 登录界面。功能基本齐全。
 * Time: 上午1:20
 */
include "header.php";?>
<title>登录--沈阳师范大学实验室管理系统</title>

</head>
<body>
<div class="container" id="container">
    <div class="page__hd">
        <h1 class="page__title">登录</h1>
        <p class="page__desc">欢迎使用沈阳师范大学实验室管理系统（试运行）</p>
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
            <input class="weui-input" id="spassword" type="password" placeholder="请输入密码">
        </div>
    </div>


    <a onclick='login()' class="weui-btn weui-btn_plain-primary">登录</a>

</div>
</body>
<script>
    function login() {
        var snumber = $("#snumber").val();
        var spassword = $("#spassword").val();
        $.post("../fun/loginfun.php",{snumber:snumber,spassword:spassword},function (result) {

            console.log(result);
                if(result!=0)
                { var jsondata= $.parseJSON(result);
                    location.href="main.php"}
                else
                {location.href="fail.html";}


        })
    }

</script>
<?php
include "footer.php"
?>
