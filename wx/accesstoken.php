<?php

/*
    方倍工作室 http://www.fangbei.org/
    CopyRight 2014 All Rights Reserved
*/

header("Content-type: text/html; charset=utf-8");
define('APPID',         	"wx04e792d1b1276267");
define('APPSECRET',        	"592e4c70088fe91ee949ac88c67d077b");


require_once('weixin.class.php');
$weixin = new class_weixin();

var_dump($result);

class class_weixin
{
    var $appid = APPID;
    var $appsecret = APPSECRET;

    //构造函数，获取Access Token
    public function __construct($appid = NULL, $appsecret = NULL)
    {
        if($appid && $appsecret){
            $this->appid = $appid;
            $this->appsecret = $appsecret;
        }

        //方法1和方法2一次只用一种，不要同时用
        //安装了memcache的环境建议用方法1，没有安装的环境建议用方法2
        
        
         //方法1. 缓存形式
         if (isset($_SERVER['HTTP_APPNAME'])){  //SAE环境，需要开通memcache
             $mem = memcache_init();
         }else {                         	   //本地环境，需已安装memcache
             $mem = new Memcache;
             $mem->connect('localhost', 11211) or die ("Could not connect");
         }
         $this->access_token = $mem->get($this->appid);
         if (!isset($this->access_token) || empty($this->access_token)){
             $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
             $res = $this->http_request($url);
             $result = json_decode($res, true);
             $this->access_token = $result["access_token"];
             $mem->set($this->appid, $this->access_token, 0, 3600);
         }

        //方法2. 本地写入
//        $res = file_get_contents('access_token.json');
//        $result = json_decode($res, true);
//        $this->expires_time = $result["expires_time"];
//        $this->access_token = $result["access_token"];
//
//        if (time() > ($this->expires_time + 3600)){
//            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
//            $res = $this->http_request($url);
//            $result = json_decode($res, true);
//            $this->access_token = $result["access_token"];
//            $this->expires_time = time();
//            file_put_contents('access_token.json', '{"access_token": "'.$this->access_token.'", "expires_time": '.$this->expires_time.'}');
//        }
    }

    protected function http_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}
