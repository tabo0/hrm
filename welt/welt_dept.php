<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>部门信息管理</title>
    <link rel="icon" href="myico.ico" type="image/x-icon" />
    <script src="http://code.jquery.com/jquery-1.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="js/menu.js"></script>
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>

<body background="../images/bk.jpg">
    <div class="tree">
        <p>宏达有限公司</p>
        <nav class="tree_menu" id="tree_menu">
            <ul><?php init(); ?></ul>
        </nav>
    </div>
    <div id="infor">
        <?php showinit()?>
    </div>
    <input type="hidden" name="ChangeFlg" id="ChangeFlg" value="1" />
    <script>
    function  showUser(str)
    {
        //$.post('getinfor.php',str);
        var url="getinfor.php"
        url=url+"?q="+str
        url=url+"&sid="
        $.post({url:url,success:function(result){$("#infor").html(result)}});
    }
</script>
</body>

</html>
<?php 

$ID=1;              //全局变量 跟踪下拉菜单的ID号
function init() 
{
    global $ID;
    $ID = 1;
    $layer = 1; //跟踪当前菜单的级数

    $link=mysqli_connect('127.0.0.1', 'root', 'root', 'hr_database');
    if ( !$link) {
        die("数据库连接失败:".mysqli_connect_error());
    }

    $link->query("SET NAMES utf8");

    $sql='select * from t_dept where N_PARENT_ID is NULL';//查询上级ID为空的 即一级菜单
    $result = mysqli_query( $link , $sql ); 
    if(mysqli_num_rows($result)>0)//一级菜单存在
    {
        ShowTreeMenu($link,$result,$layer);
    }
    mysqli_close($link);
}
function ShowTreeMenu( $Con , $result , $layer)
{//$con 数据链接  $result 需要显示的菜单记录集  $layer 需要显示的菜单级数
    global $ID;

    $numrows = mysqli_num_rows ($result); //取得需要显示的菜单的项目数
    for ( $rows = 0 ; $rows < $numrows ; $rows ++ ) 
    {
       // $menu = mysqli_fetch_array ( $result ); 
       $menu = $result->fetch_array(MYSQLI_ASSOC); //当前项的内容导入数组
        if($menu == 0)
        {
            $sql = " select * from t_dept where N_PARENT_ID is NULL " ; 
        }
        else
        {
            $sql = " select * from t_dept where N_PARENT_ID=$menu[N_DEPT_ID] " ; 
        }
        $result_sub = mysqli_query ( $Con , $sql ); //获取子菜单集
        if(mysqli_num_rows($result_sub)>0)
        {
            echo   "<li><img src='images/file4.png'><a href=\"#\" onClick='searchChange(\"change".$ID."\");showUser(\"".$menu ['VC_DEPT_NAME']."\")'>";
            echo   $menu ['VC_DEPT_NAME']; 
            echo   "</a>"; 
        }
        else
        {
            echo   "<li><img src='images/file3.png'><a href=\"#\" onClick='showUser(\"".$menu ['VC_DEPT_NAME']."\")'>";
            echo   $menu ['VC_DEPT_NAME']; 
            echo   "</a></li>"; 
        }
        if ( mysqli_num_rows ($result_sub ) > 0 ) 
        {
            echo   "<ul id=\"change".$ID++."\"";
            echo   " style='display:none'>" ; 
            $layer ++ ; 
            ShowTreeMenu( $Con , $result_sub , $layer ); //递归生成子菜单
            $layer -- ; 
            echo "</ul></li>";
        }
    }
}
function showinit(){
    $con =mysqli_connect('127.0.0.1', 'root', 'root', 'hr_database');
    if (!$con)
     {
        die("数据库连接失败:".mysqli_connect_error());
     }
     $con->query("SET NAMES utf8");
    $sql="SELECT * FROM `t_dept` limit 1";
    $result = mysqli_query( $con , $sql ); 
    $q=null;
    echo "<table class=\"table\">";
    while($row = mysqli_fetch_array($result))
     {
     $q=$row['VC_DEPT_NAME'];
     echo "<tr><th>部门编码</th>";
     echo "<td>" . $row['VC_DEPT_CODE'] . "</td></tr>";
     echo "<tr><th>部门名称</th>";
     echo "<td>" . $row['VC_DEPT_NAME'] . "</td></tr>";
     echo "<tr><th>地址</th>";
     echo "<td>" . $row['VC_LOCATION'] . "</td></tr>";
     echo "<tr><th>邮政编码</th>";
     echo "<td>" . $row['VC_POST_CODE'] . "</td></tr>";
     echo "</tr>";
     }
    $result = mysqli_query( $con , $sql ); 
    $type=['管理部门','生产部门'];
    while($row1 = mysqli_fetch_array($result))
     {
     echo "<tr><th>传真</th>";
     echo "<td>" . $row1['VC_FAX'] . "</td></tr>";
     echo "<tr><th>部门类型</th>";
     echo "<td>" . $type[$row1['N_DEPT_TYPE']] . "</td></tr>";
     echo "<tr><th>电子邮件</th>";
     echo "<td>" . $row1['VC_MAIL'] . "</td></tr>";
     echo "<tr><th>电话号码</th>";
     echo "<td>" . $row1['VC_TELEPHONE'] . "</td></tr>";
     }
     $sql2="SELECT FIRS.VC_DEPT_NAME, SECOND.VC_DEPT_NAME AS '上级' FROM t_dept FIRS, t_dept SECOND WHERE FIRS.N_PARENT_ID = SECOND.N_DEPT_ID AND FIRS.VC_DEPT_NAME='".$q."'";
     $result2 = mysqli_query( $con , $sql2 ); 
     $flat=true;
     while($row2 = mysqli_fetch_array($result2))
     {
         echo "<tr><th>上级部门</th>";
         echo "<td>" . $row2['上级'] . "</td></tr>";
         $flat=false;
     }
     if($flat)
     {
         echo "<tr><th>上级部门</th>";
         echo "<td>无</td></tr>";
     }    
     echo "</table>";
    $href1="add.php";
    $href2="modify.php?id=$q";
    $href3="getinfor.php?flag=dele&id=$q";
    echo"<div>
            <input type=\"button\" class=\"btn btn-default\" value=\"添加部门\" onclick=\"location.href='$href1'\"/>
            <input type=\"button\" class=\"btn btn-default\" value=\"修改部门\" onclick=\"location.href='$href2'\"/>
            <input type=\"button\" class=\"btn btn-default\" value=\"删除部门\" onclick=\"location.href='$href3'\"/>
        </div>";
    mysqli_close($con);
}
?>