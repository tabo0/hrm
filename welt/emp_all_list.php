<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>员工一览</title>
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
    <div class="tree" >
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
        var url="getinfor.php?flag=emp&"
        url=url+"q="+str
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
    $link = mysqli_connect('127.0.0.1','root','root','hr_database');
    if (!$link) {
        die("数据库连接失败:".mysqli_connect_error());
    }
    $link->query("SET NAMES utf8");
    $sql="SELECT * FROM `t_dept` limit 1";
    $result = mysqli_query( $link , $sql ); 
    $q=null;
    echo "<table class=\"table\">";
    while($row = mysqli_fetch_array($result))
     {
     $q=$row['N_DEPT_ID'];
     }
    $sql = "SELECT * ,VC_DEPT_NAME,VC_TITLE_NAME,VC_POST_NAME
    FROM t_employee,t_dept,t_title,t_post
    WHERE t_employee.N_TITLE_ID=t_title.N_TITLE_ID
    AND t_employee.N_POST_ID=t_post.N_POST_ID
    AND t_employee.N_DEPT_ID=t_dept.N_DEPT_ID
    AND t_dept.N_DEPT_ID=$q";

    $result = mysqli_query($link, $sql);
    $gender=['男','女'];
    echo '<div class="container mar">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr >';
    echo '<th>姓名</th>';
    echo '<th>工号</th>';
    echo '<th>部门</th>';
    echo '<th>职称</th>';
    echo '<th>岗位</th>';
    echo '<th>性别</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody >';
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        echo "<tr>";
        $id =0;
        echo '<td>'.$row['VC_EMP_NAME'].'</td>';
        echo '<td>'.$row['VC_EMP_CODE'].'</td>';
        echo '<td>'.$row['VC_DEPT_NAME'].'</td>';
        echo '<td>'.$row['VC_TITLE_NAME'].'</td>';
        echo '<td>'.$row['VC_POST_NAME'].'</td>';
        echo '<td>'.$gender[$row['N_GENDER']].'</td>';
        $id=$row['N_EMP_ID'];

        $t='查看';
        $hf='que_show.php?';
        echo "<td>";
        $href=$hf.'id='.$id;
        echo "<a href=$href>$t</a>";
        echo "</td>";
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    mysqli_close($link);

}
?>