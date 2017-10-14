<?php
/**
 * Created by PhpStorm.
 * User: likun
 * 申请界面，
 * done:2017/10/14
 * Date: 2017/9/28
 * Time: 上午8:25
 */
//session_start();
//$sname=$_SESSION['sname'];
//$sphone=$_SESSION['sphone'];
//$snumber=$_SESSION['snumber'];
//$semail=$_SESSION['semail'];

$sname=$_COOKIE['sname'];
$sphone = $_COOKIE['sphone'];
$snumber= $_COOKIE['snumber'];

if ($snumber==null)
{echo "<h2>请关闭微信浏览器并重新登录，如重新登录仍未解决，可以联系管理员</h2>";
    exit();}

include "header.php";
include "../class/mysql.class.php";
function getsysleibie(){
    //获取实验室类别
    $sql="select DISTINCT sysfwxb from sysinfo";
    $result=select($sql);
    if ($result instanceof mysqli_result)
    {
        $sysleibie=array();

        while ( $row=$result->fetch_array())
        {
            $sysleibie[]= $row[0];
        }
        return $sysleibie;
    }

}
$sysleibie=getsysleibie();


?>

<title>欢迎使用沈阳师范大学实验室管理系统</title>

</head>
<body>
<?php
echo "<input id='snumber' value='$snumber' hidden><input id='sname' value='$sname' hidden><input id='sphone' value='$sphone' hidden>"

?>
<style>
    .page__bd,.page__bd_spacing{
        display: none;
    }
    .weui-btn,.weui-btn_plain-primary{
        display: none;
    }
    .weui-cells{
        display: none;
    }
</style>
<script>


    function selected() {
        //根据选择的实验室类别，获取实验室信息
        var leixing = $("select#select1").val();
        $.post("../fun/getsysinfobylx.php",{leixing:leixing},function (result) {
           console.log(result);
           $("select#select2").empty();//实现选择第一个，清空第二列
            $("select#select2").append("<option value='null'>请选择实验室</option>");
            var json = $.parseJSON(result);
            for(var i = 0;i<json.length;i++)
            {
                var sysname = json[i].sysname;
                var syslb = json[i].syslb;
                var sysfjh = json[i].sysfjh;
                var sysid = json[i].sysid;
                $("select#select2").append("<option value='"+sysid+"'>"+sysname+"|"+syslb+"|"+sysfjh+"</option>");

            }
        })
    }
    function selectdb() {
        //根据实验室信息的选择，获取实验室课表，判断是否可预约
        var sysidl = $("select#select2").val();//这里sysidl是为了防止与下面的sysid冲突
        $.post("../fun/getsys.php",{sysidl:sysidl},function (result) {
            console.log(result);
            var json = $.parseJSON(result);
            $(".page__bd,.page__bd_spacing").css("display","block");//显示flex布局的课程表
            for(var i = 11 ;i<=80;i++)
            {
                console.log(json[i]);
            if(json[i]!=undefined){//判断回传json[i]为空，则改变<span>可预约，并添加点击函数。
                $("#"+i+"").text(json[i].sysid);//如果不为空，显示不可预约等。

            }else {
                $("#"+i+"").text("预约");
                $("#"+i+"").attr("onclick","check("+i+");");

            }
            }
        })
    }
    const array = [];
    function check(i) {
        //判断是否点击函数，如果选择 css样式改变 写进数组 取消选择 写出数组 css样式恢复
        if ($.inArray(i,array)!=-1){//判断i在数组中的位置
            array.splice($.inArray(i,array),1);
            $("#"+i+"").parent().css("background-color","#ebebeb");//取消选择，恢复css样式
            if(array[0]==null){$(".weui-btn,.weui-btn_plain-primary,.weui-cells").css("display","none");}
        }else
            {
                array.push(i);
                $("#"+i+"").parent().css("background-color","#10aeff");//选择成功，改变css样式
                $(".weui-btn,.weui-btn_plain-primary,.weui-cells").css("display","block");
            }
        console.log(array);

    }
    function apply() {//申请提交方法
        var sysid = $("select#select2").val();
        var teacher = $("#teacher").val();
        var tphone = $("#tphone").val();
        var sname = $("#sname").val();
        var snumber = $("#snumber").val();
        var sphone= $("#sphone").val();
        var date = $("#date").val();

        $.ajax({
            type:"POST",
            url:"../fun/create_record.php",
            traditional:true,
            data:{sname:sname,snumber:snumber,sphone:sphone,sysid:sysid,array:JSON.stringify(array),teacher:teacher,tphone:tphone,time:date},
            dataType:"json",
            async:false,
            success:function (result) {
                location.href="./apply_success.html";
            },
            error:function (result) {
                location.href="./fail.html";
            }
        })

    }

</script>
<div class="container" id="container"><div class="page flex js_show">
        <div class="page__hd">
            <h1 class="page__title">实验室课表</h1>
            <p class="page__desc">实验室课表查询系统</p>
        </div>
        <div class="weui-cell weui-cell_select">
            <div class="weui-cell__bd">
                <select class="weui-select" id="select1" onchange="selected()">
                    <option  value="null">请选择实验室类型</option>
                    <?php for ($i=0;$i<count($sysleibie);$i++)//循环输出实验室类别
                    {
                        echo "<option value=\"$sysleibie[$i]\">$sysleibie[$i]实验室</option>";
                    }?>

                </select>
            </div>
        </div>
        <div class="weui-cell weui-cell_select">
            <div class="weui-cell__bd">

                <select class="weui-select" id="select2" onchange="selectdb()" >
                    <option  value="null">请选择实验室</option>
                </select>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label for="" class="weui-label">预约日期</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" id="date" type="date" value="">
            </div>
        </div>
        <div class="page__bd page__bd_spacing">
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">节/周</div></div>
                <div class="weui-flex__item"><div class="placeholder" id="1">周一</div></div>
                <div class="weui-flex__item"><div class="placeholder" id="2">周二</div></div>
                <div class="weui-flex__item"><div class="placeholder" id="3">周三</div></div>
                <div class="weui-flex__item"><div class="placeholder" id="4">周四</div></div>
                <div class="weui-flex__item"><div class="placeholder" id="5">周五</div></div>
                <div class="weui-flex__item"><div class="placeholder" id="6">周六</div></div>
                <div class="weui-flex__item"><div class="placeholder" id="7">周日</div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">1</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="11">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="21">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="31">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="41">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="51">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="61">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="71">预约</span></div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">2</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="12">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="22">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="32">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="42">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="52">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="62">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="72">预约</span></div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">3</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="13">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="23">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="33">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="43">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="53">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="63">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="73">预约</span></div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">4</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="14">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="24">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="34">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="44">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="54">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="64">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="74">预约</span></div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">5</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="15">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="25">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="35">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="45">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="55">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="65">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="75">预约</span></div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">6</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="16">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="26">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="36">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="46">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="56">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="66">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="76">预约</span></div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">7</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="17">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="27">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="37">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="47">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="57">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="67">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="77">预约</span></div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">8</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="18">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="28">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="38">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="48">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="58">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="68">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="78">预约</span></div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">9</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="19">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="29">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="39">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="49">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="59">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="69">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="79">预约</span></div></div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder">10</div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="20">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="30">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="40">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="50">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="60">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="70">预约</span></div></div>
                <div class="weui-flex__item"><div class="placeholder"><span id="80">预约</span></div></div>
            </div>

        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" id="teacher" type="text" placeholder="请输入指导教师">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" id="tphone" type="text" placeholder="请输入指导教师联系方式">
                </div>
            </div>
        </div>
        <a onclick='apply()' class="weui-btn weui-btn_plain-primary">进行预约</a>

    </div></div>


</body>
