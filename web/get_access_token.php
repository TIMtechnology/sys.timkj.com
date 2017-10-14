<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/9/28
 * Time: 下午2:05
 * 微信模板消息。（正式版上线删除）
 */
$appid = "wx04e792d1b1276267";
$appsecret = "592e4c70088fe91ee949ac88c67d077b";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$info = json_decode($output, true);
$access_token=$info['access_token'];
$url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
$data=array("touser"=>"$openid","template_id"=>"b0CY4Ny6PX4_xIUyYeEFmYBM72geWUPh7L9ZfLRUh3A", "data"=>array("first"=>array("value"=>"用户信息","color"=>"#173177"), "sname"=>array("value"=>"$sname","color"=>"#173177"), "snumber"=>array("value"=>"$snumber","color"=>"#173177"), "semail"=>array("value"=>"$semail","color"=>"#173177")));
$data=json_encode($data);
//print_r($data);
$post_data = $data;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// post数据
curl_setopt($ch, CURLOPT_POST, 1);
// post的变量
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$output = curl_exec($ch);
curl_close($ch);
//打印获得的数据
print_r($output);
?>