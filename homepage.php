<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>人力资源管理系统</title>
    <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="static/css/main.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="static/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="static/js/bootstrap.min.js"></script>
    <link rel="icon" href="myico.ico" type="image/x-icon" />

    <link href="static/css/new.css" rel="stylesheet" type="text/css"/>
    <style>
        body
        {
            background: url('images/bk.jpg');
        }
    </style>
</head>
<body >
<script type="text/javascript" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js"></script>

<div style="">
    <?php is_login(); ?>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">&nbsp;&nbsp;人力资源管理系统</a>
            </div>
        </div>
    </nav>
<!--<h2 class='head' style="">&nbsp;人力资源管理系统</h2>-->
</div>
    <div>
        <div class="container-fluid" >
                <div class="row">
                <div class="col-md-2">
                    <ul id="main-nav" class="nav nav-tabs nav-stacked">

                        <li>
                            <a href="#systemSetting1" class="nav-header collapsed" data-toggle="collapse">
                                <i class="glyphicon "></i>
                                <p style="color:blue ;text-align:center;font-size: 20px">职称岗位管理</p>
                            </a>
                            <ul id="systemSetting1" class="nav nav-list collapse secondmenu">
                                <li><a href="job/job_title.php" target="myframe"><p style="text-align:center;font-size: 15px">职称管理</p></a></li>
                                <li><a href="post/post_title.php" target="myframe"><p style="text-align:center;font-size: 15px">岗位管理</p></a></li>
                            </ul>
                        </li>

                    </ul>
                    <ul id="main-nav" class="nav nav-tabs nav-stacked">

                        <li>
                            <a href="#systemSetting2" class="nav-header collapsed" data-toggle="collapse">
                                <i class="glyphicon "></i>
                                <p style="color:blue ;text-align:center;font-size: 20px">员工管理</p>
                            </a>
                            <ul id="systemSetting2" class="nav nav-list collapse secondmenu">
                                <li><a href="emp/emp_input.php" target="myframe"><p style="text-align:center;font-size: 15px">员工信息录入</p></a></li>
                                <li><a href="emp/emp_maintain.php" target="myframe"><p style="text-align:center;font-size: 15px">员工信息维护</p></a></li>
                                <li><a href="emp/emp_change.php" target="myframe"><p style="text-align:center;font-size: 15px">员工任职变更</p></a></li>
                            </ul>
                        </li>

                    </ul>
                    <ul id="main-nav" class="nav nav-tabs nav-stacked">

                        <li>
                            <a href="#systemSetting3" class="nav-header collapsed" data-toggle="collapse">
                                <i class="glyphicon "></i>
                                <p style="color:blue ;text-align:center;font-size: 20px">查询统计</p>
                            </a>
                            <ul id="systemSetting3" class="nav nav-list collapse secondmenu">
                                <li><a href="welt/welt_query.php" target="myframe"><p style="text-align:center;font-size: 15px">综合查询</p></a></li>
                                <li><a href="welt/que_chart.php" target="myframe"><p style="text-align:center;font-size: 15px">汇总统计</p></a></li>
                            </ul>
                        </li>

                    </ul>
                    <ul id="main-nav" class="nav nav-tabs nav-stacked">

                        <li>
                            <a href="#systemSetting4" class="nav-header collapsed" data-toggle="collapse">
                                <i class="glyphicon "></i>
                                <p style="color:blue ;text-align:center;font-size: 20px">	组织机构管理</p>
                            </a>
                            <ul id="systemSetting4" class="nav nav-list collapse secondmenu">
                                <li><a href="welt/welt_dept.php" target="myframe"><p style="text-align:center;font-size: 15px">查看部门信息</p></a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div class="col-md-10" >
                	<iframe src="welcome.php" name="myframe" width="100%" height="650" frameborder="0" scrolling="yes"></iframe>
                </div>
                </div>
        </div>
    </div>
</body>
</html>
<?php
function is_login(){
    $user ='';
    if (!isset($_COOKIE['user']))
    {
        echo '<script> alert("请登录!"); location="login.html";</script>';
    }
}
?>