<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>部门信息添加</title>

    <link href="new.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" href="myico.ico" type="image/x-icon" />
    <script src="http://code.jquery.com/jquery-1.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body background="../images/bk.jpg">
<?php     $link = mysqli_connect('127.0.0.1','root','root','hr_database');
if (!$link) {
    die("连接失败:".mysqli_connect_error());
}
$link->query("SET NAMES utf8");
$sql ="select VC_DEPT_NAME, N_DEPT_ID from t_dept";
$result = mysqli_query($link, $sql);
$info=array();
while($row = mysqli_fetch_row($result)){
    array_push($info,$row);
}

mysqli_close($link);
?>
<div class="container mar ">
    <h1 class="newcenter" align="center"> 部门信息添加</h1>

    <form class="form-horizontal" role="form">
        <div class="form-group" hidden>
            <label for="firstname" class="col-sm-2 control-label">id<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id">
            </div>
        </div>
    </form>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">部门编码<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="code" placeholder="1-30字符">
            </div>
        </div>
    </form>    
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">部门名称<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="20-500字符">
            </div>
        </div>
    </form>    
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">地址<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="addr" placeholder="20-500字符">
            </div>
        </div>
    </form>   
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">邮政编码<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="post" placeholder="20-500字符">
            </div>    
        </div>
    </form>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">传真<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="fox" placeholder="20-500字符">
            </div>
        </div>
    </form>
    <form class="form-horizontal" role="form" >
        <div class="form-group" style="height:34px">
            <label for="firstname" class="col-sm-2 control-label">部门类型<span style="color: red">*</span></label>
            <div class="col-sm-10" style="height:34px">
                <select class="form-control" id="type" style="height:34px">
                    <option value="0">管理部门</option>
                    <option value="1">生产部门</option>
                </select>
            </div>
        </div>
    </form>
   
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">电子邮件<span style="color: red">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" placeholder="20-500字符">
            </div>
        </div>
    </form>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">电话号码<span style="color: red">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tele" placeholder="20-500字符">
            </div>
        </div>
    </form>
    <form class="form-horizontal" role="form" >
        <div class="form-group" style="height:34px">
            <label for="firstname" class="col-sm-2 control-label">上级部门<span style="color: red">*</span></label>
            <div class="col-sm-10" style="height:34px">
                <select class="form-control" id="par" style="height:34px">
                <?php
                    echo "<option value='null'>无</option>";
                    for($x=0;$x<count($info);$x++) {
                        echo "<option value=".(string)$info[$x][1].">".$info[$x][0]."</option>";
                      }
                ?>
                </select>
            </div>
        </div>
    </form>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" onclick="return submit()">提交</button>
        </div>
    </div>
</div>
<script>
        function  submit(){
            var code = $('#code').val();
            var name = $('#name').val();
            var addr = $('#addr').val();
            var post = $('#post').val();
            var fox = $('#fox').val();
            var type = $('#type').val();
            var email = $('#email').val();
            var tele = $('#tele').val();
            var par = $('#par').val();
            if(code.length ==0 ||code.length>30){
                alert('部门编号长度不符合!');
                return false;
            }
            if(name.length ==0 ||code.length>20){
                alert('部门名称长度不符合!');
                return false;
            }
            /*if(addr.length < 20  ||addr.length>50){
                alert('地址长度不符合!');
                return false;
            }
            if(post.length < 20  ||post.length>50){
                alert('邮编目标长度不符合!');
                return false;
            }
            if(fox.length < 20  ||fox.length>50){
                alert('传真目标长度不符合!');
                return false;
            }
            if(email.length < 20  ||email.length>50){
                alert('邮箱目标长度不符合!');
                return false;
            }
            if(tele.length < 20  ||tele.length>50){
                alert('电话目标长度不符合!');
                return false;
            }*/
            alert('添加成功!');
            var con = {
                code: code,
                name: name,
                addr: addr,
                post: post,
                fox: fox,
                type: type,
                email: email,
                tele: tele,
                par: par,
                flag: 'add',
            };
            $.post('getinfor.php', con, function (data) {
                alert(data);
            });
            window.location.href = "welt_dept.php";
    }
    </script>
    </body>
</html>   