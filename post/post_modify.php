<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>题目-Online Judge</title>

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

<body>
<?php     $link = mysqli_connect('127.0.0.1','root','root','hr_database');
if (!$link) {
    die("连接失败:".mysqli_connect_error());
}
$a=$_GET['id'];
$sql ="select * from t_post where N_POST_ID=$a;";
$result = mysqli_query($link, $sql);
$info=null;
while($row = mysqli_fetch_row($result)){
    $info=$row;
}
$data=$info[2];
$rs = mysqli_query($link, "select VC_POST_NAME from t_post where N_POST_ID=$data;");
$ans=mysqli_fetch_array($rs);
if($ans) $data=$ans[0];
else $data='无';
$info[2]=$data;
mysqli_close($link);
?>
<div class="container mar ">
    <h1 class="newcenter" align="center"> 修改岗位信息<span style="color: red">*必填</span></h1>

    <form class="form-horizontal" role="form">
        <div class="form-group" hidden>
            <label for="firstname" class="col-sm-2 control-label">id<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id"  value=<?php echo $a?>>
            </div>

        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">岗位名称<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="1~30字符" value=<?php echo $info[1]?>>
            </div>

        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">上级岗位<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="father" placeholder="1~30字符" value=<?php echo $info[2]?>>
            </div>

        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">岗位职责<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <textarea type="text"  rows=4 class="form-control" id="zhize" placeholder="20~500字符" ><?php echo $info[3]?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">任职资格<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <textarea type="text"  rows=4 class="form-control" id="zige" placeholder="20~500字符" ><?php echo $info[4]?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">岗位权限<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <textarea type="text"  rows=4 class="form-control" id="quanxian" placeholder="20~500字符" ><?php echo $info[5]?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">岗位工作内容<span style="color: red"> *</span></label>
            <div class="col-sm-10">
                <textarea type="text"  rows=4 class="form-control" id="work" placeholder="20~500字符"  ><?php echo $info[6]?></textarea>
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
        var name =$('#name').val();
        var zige =$ ('#zige').val();
        var zhize = $('#zhize').val();
        var work= $('#work').val();
        var father= $('#father').val();
        var quanxian= $('#quanxian').val();
        var id=$('#id').val();
        if(name.length ==0 ||name.length>30){
            alert('岗位名称长度不符合!');
            return false;
        }
        if(father.length < 1  ||father.length>30){
            alert('上级岗位长度不符合!');
            return false;
        }
        if(zhize.length < 20  ||zhize.length>500){
            alert('岗位职责不符合!');
            return false;
        }
        if(zige.length < 20  ||zige.length>500){
            alert('任职资格长度不符合!');
            return false;
        }
        if(quanxian.length < 20  ||quanxian.length>500){
            alert('岗位权限长度不符合!');
            return false;
        }
        if(work.length < 20  ||work.length>500){
            alert('岗位工作内容长度不符合!');
            return false;
        }
       // alert(id)
        alert('修改成功!');
        var con = {
           id:id, name:name,father:father,zige:zige,zhize:zhize,quanxian:quanxian,work:work,flag:'modify',
        };
        $.post('post_action.php',con,function(data){
           // alert(data);
        });
        window.location.href = "post_title.php";
    }
</script>
</body>
</html>