<?php
/**
 * Created by PhpStorm.
 * User: likun
 * Date: 2017/9/29
 * Time: 下午10:06
 * 实验室信息表录入系统
 */

include "../web/header.php";
include "../class/mysql.class.php";
require_once "../admin/Spreadsheet_Excel_Reader.class.php"
?>
<!--<title>实验室信息录入系统</title>-->
<!--</head>-->
<!--<input type="file">-->
<?php
function readexcel(){
    $data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding('UTF-8');
//    /www/wwwroot/sys.timkj.com/admin/geturl.php
     $data ->read("1.xls");

    for($i=1;$i<=$data->sheets[0]['numRows'];$i++){
        for ($j=1;$j<=$data->sheets[0]['numCols'];$j++){
            $array[$i-1][$j-1]=$data->sheets[0]['cells'][$i][$j];
        }
    }

    return $array;
}

$array=readexcel();

$a=count($array);
print_r($a);
 for ($j=0;$j<=$a;$j++)
 {
     $array1=$array[$j];

     $sql="insert into sysinfo(sysid, sysname, syslb, sysfjh, sysfzr, sysfzrdh, sysfzrdh1, sysfzrdz, sysfwxb) 
VALUES ('$array1[0]','$array1[3]','$array1[1]','$array1[2]','$array1[4]','$array1[6]','$array1[7]','$array1[5]','$array1[8]')";
     print_r($sql);
     $result=insert($sql);
     print_r($result);
 }

?>