<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>部门信息管理</title>
    <link rel="icon" href="myico.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="new.css" rel="stylesheet" type="text/css"/>
    <style>
        body * {margin: 0;padding: 0;}
        div.text {text-align:center}
        div.container {
            position: relative;
            width:600px;
            left: 210px;
            float:left;
        }
        div.button {
            position: relative;
            width:600px;
            left: 240px;
            top:80px;
            float:left;
        }
        .dpre{
            margin: 0px;
            background: white;
            border:none;
            font-size: 18px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>

<body background="../images/bk.jpg">
<?php     
$link = mysqli_connect('127.0.0.1','root','root','hr_database');
if (!$link) {
    die("连接失败:".mysqli_connect_error());
}
$a=$_GET['id'];
$link->query("SET NAMES utf8");
$sql = "SELECT * ,VC_DEPT_NAME,VC_TITLE_NAME,VC_POST_NAME
    FROM t_employee,t_dept,t_title,t_post
    WHERE N_EMP_ID =$a
    AND t_employee.N_TITLE_ID=t_title.N_TITLE_ID
    AND t_employee.N_POST_ID=t_post.N_POST_ID
    AND t_employee.N_DEPT_ID=t_dept.N_DEPT_ID";
$result = mysqli_query($link, $sql);
$info=null;
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $info=$row;
}
mysqli_close($link);
$gender=['男','女'];
$regtype=['城镇户口','农村户口'];
$edu=['','高中','专科','本科','硕士','博士'];
$party=['','中共党员','中共预备党员','共青团员','民主党派','群众'];
$heal=['','良好','健康','一般','有慢性疾病'];
$nantion=["","汉族", "壮族", "满族", "回族", "苗族", "维吾尔族", "土家族", "彝族", "蒙古族", "藏族", "布依族", "侗族", "瑶族", "朝鲜族", "白族", "哈尼族",
"哈萨克族", "黎族", "傣族", "畲族", "傈僳族", "仡佬族", "东乡族", "高山族", "拉祜族", "水族", "佤族", "纳西族", "羌族", "土族", "仫佬族", "锡伯族",
"柯尔克孜族", "达斡尔族", "景颇族", "毛南族", "撒拉族", "布朗族", "塔吉克族", "阿昌族", "普米族", "鄂温克族", "怒族", "京族", "基诺族", "德昂族", "保安族",
"俄罗斯族", "裕固族", "乌孜别克族", "门巴族", "鄂伦春族", "独龙族", "塔塔尔族", "赫哲族", "珞巴族"];
$status=['','转正','试用','挂靠','自动离职','辞退'];
?>
<div class="text"><h1 class="newcenter"> 查询结果</h1></div>
    <div class="container">
        <div class="panel panel-info mar">
            <div class="panel-heading">
                <h3 class="panel-title">姓名</h3>
            </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info['VC_EMP_NAME'] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">性别</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $gender[$info['N_GENDER']] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">职称</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info['VC_TITLE_NAME'] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">出生年月</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info['D_BIRTHDAY'] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">健康状况</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $heal[$info['N_HEALTH']] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">身份证号</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info['VC_IDCARD_CODE'] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">籍贯</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info['VC_NATIVE_PLACE'] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">户口类型</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $regtype[$info['N_REG_TYPE']] ;?></pre>
        </div>
    </div>
</div>
<div class="container">
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">员工号</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info['VC_EMP_CODE'] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">部门</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info['VC_DEPT_NAME'] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">岗位</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info['VC_POST_NAME'] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">学历</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $edu[$info['N_EDU_LEVEL']] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">政治面貌</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $party[$info['N_PARTY']] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">民族</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $nantion[$info['N_NANTION']] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">状态</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $status[$info['N_STATUS']] ;?></pre>
        </div>
    </div>
    <div class="button">
        <button type="submit" class="btn btn-default" onclick="javascript:history.back()">返回</button>
    </div>
</div>
</body>

</html>
