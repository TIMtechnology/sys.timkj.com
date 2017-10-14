<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/9/27
 * Time: 下午10:41
 * mysql数据库链接
 */
const mysql_server="";
const mysql_username="";
const mysql_password="";
const mysql_database="";

function insert($sql){

    $conn=new mysqli(mysql_server,mysql_username,mysql_password,mysql_database) or die("error connecting") ; //连接数据库
    $result = $conn->query("$sql");
    $conn->close();
    return $result;

}
function select($sql){
    $conn=new mysqli(mysql_server,mysql_username,mysql_password,mysql_database) or die("error connecting") ; //连接数据库
    $result = $conn->query("$sql");
    $conn->close();
    return $result;
}