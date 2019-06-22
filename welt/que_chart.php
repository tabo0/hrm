<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>查询统计</title>

    <link href="new.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" href="myico.ico" type="image/x-icon" />
    <script src="http://code.jquery.com/jquery-1.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="js/echarts.min.js"></script>
    <style>
        body * {margin: 0;padding: 0;}
        div.text {text-align:center}
        .chart {
            position: relative;
            width:600px;
            height:400px;
            left: 100px;
            top:40px;
            float:left
        }
        .container{
            position: relative;
            width:600px;
            height:400px;
            left: 100px;
            top:40px;
            float:left
        }
    </style>
</head>

<body background="../images/bk.jpg">
<?php     
$edu=['','高中','专科','本科','硕士','博士'];
$link = mysqli_connect('127.0.0.1','root','root','hr_database');
if (!$link) {
    die("连接失败:".mysqli_connect_error());
}
$link->query("SET NAMES utf8");
$sql1 ="SELECT N_EDU_LEVEL,COUNT(N_EDU_LEVEL) FROM t_employee GROUP BY N_EDU_LEVEL";
$sql2 ="SELECT t_title.VC_TITLE_NAME, COUNT(t_employee.N_TITLE_ID) FROM t_employee, t_title WHERE t_employee.N_TITLE_ID = t_title.N_TITLE_ID GROUP BY t_employee.N_TITLE_ID";
$result1 = mysqli_query($link, $sql1);
$result2 = mysqli_query($link, $sql2);
$i=0;
$info1=null;$all1=null;
$info2=null;$all2=null;
//$ss=$s;
while($row1 = mysqli_fetch_row($result1)){
    $row1[0]=$edu[$row1[0]];
    $all1 += $row1[1];
    $info1[$i]=$row1;
    $name1[$i]=$row1[0];
    $data1[$i++]=$row1[1];
}
// 把PHP数组转成JSON字符串
// 写入文件
class Data{   
    public $edu;   
    public $edudata;
    public $title;   
    public $titledata;
}    
$i=0;
while($row2 = mysqli_fetch_row($result2)){
    $all2 += $row2[1];
    $info2[$i]=$row2;
    $name2[$i]=$row2[0];
    $data2[$i++]=$row2[1];
}
  $da  =new Data; //创建一个对象   
  $da->edu = $name1;   
  $da->edudata = $data1;
  $da->title = $name2;   
  $da->titledata = $data2;
  $f = fopen("data.json","w") or die("fail to open");   

    fwrite($f,json_encode($da,JSON_UNESCAPED_UNICODE));   

    fclose($f);
mysqli_close($link);
?>
<div class="text"><h1 class="newcenter"> 汇总统计</h1></div>

<div class="container">
    <table class="table">
        <thead>
        <tr >
            <th>序号</th>
            <th>学历</th>
            <th>所占人数</th>
            <th>比例</th>
        </tr>
        </thead>
        <tbody >
        <tr >
            <td>1</td>
            <td><?php echo $info1[0][0]?></td>
            <td><?php echo $info1[0][1]?></td>
            <td><?php echo $info1[0][1]/$all1*100;echo'%'?></td>
        </tr>
        <tr >
            <td>2</td>
            <td><?php echo $info1[1][0]?></td>
            <td><?php echo $info1[1][1]?></td>
            <td><?php echo $info1[1][1]/$all1*100;echo'%'?></td>
        </tr>
        <tr >
            <td>3</td>
            <td><?php echo $info1[2][0]?></td>
            <td><?php echo $info1[2][1]?></td>
            <td><?php echo $info1[2][1]/$all1*100;echo'%'?></td>
        </tr>
        <tr >
            <td>4</td>
            <td><?php echo $info1[3][0]?></td>
            <td><?php echo $info1[3][1]?></td>
            <td><?php echo $info1[3][1]/$all1*100;echo'%'?></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="chart" id="main1"></div>
<div class="container">
    <table class="table">
        <thead>
        <tr >
            <th>序号</th>
            <th>职称</th>
            <th>所占人数</th>
            <th>比例</th>
        </tr>
        </thead>
        <tbody >
        <tr >
            <td>1</td>
            <td><?php echo $info2[0][0]?></td>
            <td><?php echo $info2[0][1]?></td>
            <td><?php echo $info2[0][1]/$all1*100;echo'%'?></td>
        </tr>
        <tr >
            <td>2</td>
            <td><?php echo $info2[1][0]?></td>
            <td><?php echo $info2[1][1]?></td>
            <td><?php echo $info2[1][1]/$all1*100;echo'%'?></td>
        </tr>
        <tr >
            <td>3</td>
            <td><?php echo $info2[2][0]?></td>
            <td><?php echo $info2[2][1]?></td>
            <td><?php echo $info2[2][1]/$all1*100;echo'%'?></td>
        </tr>
        <tr >
            <td>4</td>
            <td><?php echo $info2[3][0]?></td>
            <td><?php echo $info2[3][1]?></td>
            <td><?php echo $info2[3][1]/$all1*100;echo'%'?></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="chart" id="main2"></div>

<script src="js/showcharts.js"></script>
</body>
</html>