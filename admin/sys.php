<?php
/**
 * Created by PhpStorm.
 * User: likun
 * 实现课程导入。
 *
 * Date: 2017/9/30
 * Time: 上午10:25
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
    $data ->read("2.xls");//表名

    for($i=1;$i<=$data->sheets[0]['numRows'];$i++){
        for ($j=1;$j<=$data->sheets[0]['numCols'];$j++){
            $array[$i-1][$j-1]=$data->sheets[0]['cells'][$i][$j];
        }
    }

    return $array;
}

$array=readexcel();
print_r($array);

$a=count($array);

for ($j=0;$j<=$a;$j++)
{
    $array1=$array[$j];

    $sql="insert into sys(sysid,startweek,endweek,courseid) VALUES ('$array1[0]','$array1[1]','$array1[2]','$array1[3]')";
    $result=insert($sql);
    print_r($result);
}
