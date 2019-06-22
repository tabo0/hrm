<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>部门信息修改</title>

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
$a=$_GET['id'];
$link->query("SET NAMES utf8");
$sql ="select * from t_dept where VC_DEPT_NAME ='".$a."'";
$result = mysqli_query($link, $sql);
$info=null;
while($row = mysqli_fetch_row($result)){
    $info=$row;
}
$sql ="select VC_DEPT_NAME, N_DEPT_ID from t_dept";
$result = mysqli_query($link, $sql);
$par=array();
while($row = mysqli_fetch_row($result)){
    array_push($par,$row);
}
mysqli_close($link);
?>
<div class="container mar ">
    <h1 class="newcenter" align="center">部门信息修改</h1>

    <form class="form-horizontal" role="form">
        <div class="form-group" hidden>
            <label for="firstname" class="col-sm-2 control-label">id<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id"  value=<?php echo $info[0]?>>
            </div>
        </div>
    </form>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">部门编码<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="code" placeholder="1-30字符" value=<?php echo $info[1]?>>
            </div>
        </div>
    </form>    
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">部门名称<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="20-500字符"value=<?php echo $info[2]?>>
            </div>
        </div>
    </form>    
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">地址<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="addr" placeholder="20-500字符"value=<?php echo $info[5]?>>
            </div>
        </div>
    </form>   
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">邮政编码<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="post" placeholder="20-500字符" value=<?php echo $info[6]?>>
            </div>    
        </div>
    </form>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">传真<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="fox" placeholder="20-500字符" value=<?php echo $info[8]?>>
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
                <input type="hidden" class="form-control" id="type23" placeholder="20-500字符"value=<?php echo $info[3]?>>
            </div>
        </div>
    </form>
   
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">电子邮件<span style="color: red">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" placeholder="20-500字符"value=<?php echo $info[9]?>>
            </div>
        </div>
    </form>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">电话号码<span style="color: red">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tele" placeholder="20-500字符"value=<?php echo $info[7]?>>
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
                    for($x=0;$x<count($par);$x++) {
                        echo "<option value=".(string)$par[$x][1].">".$par[$x][0]."</option>";
                      }
                ?>
                </select>
                <input type="hidden" id="par23" value=<?php echo $info[4]?>>
            </div>
        </div>
    </form>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" onclick="return submit()">提交</button>
        </div>
    </div>
    <script>$("#type").val($("#type23").val());$("#par").val($("#par23").val());//设置value为xx的option选项为默认选中</script>
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
            var old = $('#id').val();
            alert('修改成功!');
            var con = {
                code: code,
                name: name,
                addr: addr,
                post: post,
                fox: fox,
                type: type,
                email: email,
                tele: tele,
                old: old,
                flag: 'updete',
            };
            $.post('getinfor.php', con, function (data) {
                alert(data);
            });
            window.location.href = "welt_dept.php";
    }
    </script>
    </body>
</html>   