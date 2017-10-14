<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/10/10
 * Time: 下午1:07
 * 登出账号 清理cookie
 */
include "../web/header.php";
setcookie("snumber",'',time()-3600,'/','.sys.timkj.com');
setcookie("sname",'',time()-3600,'/','.sys.timkj.com');
setcookie("sphone",'',time()-3600,'/','.sys.timkj.com');
setcookie("sxueyuan",'',time()-3600,'/','.sys.timkj.com');
setcookie("syuanxi",'',time()-3600,'/','.sys.timkj.com');
echo "登出成功，如有问题请联系管理员";