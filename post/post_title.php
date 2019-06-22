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
    <style>
        table { table-layout: fixed;}
        table tr td {
            overflow:hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
            -o-text-overflow:ellipsis;
            -moz-text-overflow: ellipsis;
            -webkit-text-overflow: ellipsis;
        }
    </style>
</head>

<body background="../images/bk.jpg">
<div class="container mar">
    <table class="table">
        <thead>
        <tr >
            <th>岗位名称</th>
            <th>上级岗位</th>
            <th>岗位职责</th>
            <th>任职资格</th>
            <th>岗位权限</th>
            <th>岗位工作内容</th>
        </tr>
        </thead>
        <tbody >
        <?php init(); ?>
        <td><a href="post_add.php">添加</a>&nbsp;&nbsp;<a href="post_title.php">刷新</a></td>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js"></script>
</body>
</html>
<?php
function init(){
    $link = mysqli_connect('127.0.0.1','root','root','hr_database');
    //$link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("数据库连接失败:".mysqli_connect_error());
    }
    $sql = 'select * from t_post;';

    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_row($result)){
        echo "<tr>";
        $flag=0;
        $id =0;
        foreach($row as $data){
            if($flag==2){
                $rs = mysqli_query($link, "select VC_POST_NAME from t_post where N_POST_ID=$data;");

                $a=mysqli_fetch_array($rs);
                if($a) $data=$a[0];
                else $data='无';
            }
            if($flag)   echo '<td>'.$data.'</td>';
            else if($flag==0)$id=$data;
            $flag++;
        }
        $t=['修改','删除','查看'];
        $hf=['post_modify.php?','post_action.php?flag=delete&','post_show.php?'];
        echo "<td>";
        for($i=0;$i<3;$i++){
            $href=$hf[$i].'id='.$id;
            echo "<a href=$href onclick='return del();'>$t[$i]</a>&nbsp;&nbsp;";
        }
        echo "</td>";
        echo '</tr>';
    }
    mysqli_close($link);
}
?>
<script>
    function del()
    {
        if(confirm("确定要删除吗？"))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>
