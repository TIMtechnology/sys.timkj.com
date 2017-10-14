<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/21
 * Time: 下午 9:54
 * 暂时未获得微信认证。
 */
$appid = 'wx04e792d1b1276267';
$appsecret = '592e4c70088fe91ee949ac88c67d077b';
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret=$appsecret";
$output = https_request($url);
$jsoninfo = json_decode($output,true);
var_dump($jsoninfo);
$access_token = $jsoninfo["access_token"];
$jsonmenu = '
     {
     "button":[
     
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"登录",
               "url":"http://sys.timkj.com/web/login.php"
            },
            {
                 "type":"view",
                 "name":"注册",
                 "url":"http://sys.timkj.com/web/register.php",
             },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
 }
   ';


//创建菜单实现
$url ="https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
$result = https_request($url,$jsonmenu);
var_dump($result);
function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
    if(!empty($data)){
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    }
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}