<?php
require_once('./weixin.class.php');
$weixin = new weixin();
if (isset($_GET['code'])){
    $code =$_GET['code'];
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx04e792d1b1276267&secret=592e4c70088fe91ee949ac88c67d077b&code=$code&grant_type=authorization_code";
    $re = $weixin->oauth2_access_token($url);
    print_r($re['openid']);
    $openid=$re['openid'];
    Header("location:http://sys.timkj.com/web/register.php?openid=$openid");
}else{
    echo "NO CODE,请联系管理员";

}
?>