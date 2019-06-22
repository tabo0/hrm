<!DOCTYPE html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>题目-Online Judge</title>
    <link rel="icon" href="myico.ico" type="image/x-icon" />

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="new.css" rel="stylesheet" type="text/css"/>
    <style>
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
<body  >
<?php     $link = mysqli_connect('127.0.0.1','root','root','hr_database');
if (!$link) {
    die("连接失败:".mysqli_connect_error());
}
$a=$_GET['id'];
$sql ="select * from t_post where N_POST_ID=$a;";
$result = mysqli_query($link, $sql);
//echo "<script>alert($result[0]);</script>";
$info=null;
while($row = mysqli_fetch_row($result)){
    $info=$row;
}
$data=$info[2];
$rs = mysqli_query($link, "select VC_POST_NAME from t_post where N_POST_ID=$data;");
$a=mysqli_fetch_array($rs);
if($a) $data=$a[0];
else $data='无';
$info[2]=$data;
mysqli_close($link);
?>
<div class="container">
    <h1 class="newcenter" align="center"> 查看岗位信息</h1>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">岗位名称</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info[1] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">上级岗位</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info[2] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">岗位职责</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info[3] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">任职资格</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info[4] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">岗位权限</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info[5] ;?></pre>
        </div>
    </div>
    <div class="panel panel-info mar">
        <div class="panel-heading">
            <h3 class="panel-title">岗位工作内容</h3>
        </div>
        <div class="panel-body">
            <pre class='dpre'><?php echo $info[6] ;?></pre>
        </div>
    </div>
    <a href="post_title.php">返回</a>
</div>
<script type="text/javascript" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js"></script>
</body>
</html>