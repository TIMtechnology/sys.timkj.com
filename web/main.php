<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/10/9
 * Time: 下午3:33
 * 个人中心，去向 一 申请  二 查询记录，申请通过查询。未来采用微信推送。
 *
 */
$sname = $_COOKIE['sname'];
$snumber = $_COOKIE['snumber'];
$sphone = $_COOKIE['sphone'];
$sxueyuan = $_COOKIE['sxueyuan'];
$syuanxi = $_COOKIE['syuanxi'];
include "../web/header.php"
?>
<title>个人中心--沈阳师范大学实验室管理系统</title>
</head>
<div class="container" id="container">
    <div class="page__hd">
        <h1 class="page__title">个人中心</h1>
        <p class="page__desc">个人中心，您可以在这里前往申请预约实验室，以及查看申请记录，申请通过情况。</p>
    </div>

    <div class="profile">
        <div class="weui_cells weui_cells_access">
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>姓名</p>
                </div>
                <div class="weui_cell_ft">
                    <?php echo $sname?>
                </div>
            </div>
            <div class="weui_cell no_access">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>手机号</p>
                </div>
                <div class="weui_cell_ft">
                    <?php echo $sphone?>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>学号</p>
                </div>
                <div class="weui_cell_ft">
                    <?php echo $snumber?>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>所属学院</p>
                </div>
                <div class="weui_cell_ft">
                    <?php echo $sxueyuan?>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>所属院系</p>
                </div>
                <div class="weui_cell_ft">
                    <?php echo $syuanxi?>
                </div>
            </div>
        </div>
    </div>

    <div class="weui-flex">
        <div class="weui-flex__item"><a href="apply.php" class="weui-btn weui-btn_plain-primary">申请预约</a></div>
        <div class="weui-flex__item"><a href="apply_log.php" class="weui-btn weui-btn_plain-primary">查看记录</a></div>
    </div>
    <a href="../fun/lgout.php" style=" float: right;margin-top: 2em;" class="weui-btn weui-btn_mini weui-btn_primary">退出登录</a>

</div>