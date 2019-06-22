<?php
if(isset($_POST['flag'])&&$_POST['flag']=='updete') updete();//根据 flag 判断 执行什么函数
elseif(isset($_POST['flag'])&&$_POST['flag']=='add') add();
elseif(isset($_GET['flag'])&&$_GET['flag']=='dele') dele();
elseif(isset($_GET['flag'])&&$_GET['flag']=='emp') emp();
else show();
function emp(){
    $q=$_GET["q"];

    $link = mysqli_connect('127.0.0.1','root','root','hr_database');
    if (!$link) {
        die("数据库连接失败:".mysqli_connect_error());
    }
    $link->query("SET NAMES utf8");
    $sql="SELECT * from t_dept where VC_DEPT_NAME = '".$q."'";
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
function updete(){
  $link = mysqli_connect('127.0.0.1','root','root','hr_database');
  if (!$link) {
      die("连接失败:".mysqli_connect_error());
  }
  $link->query("SET NAMES utf8");

  $code=$_POST['code'];         //数据库更新操作
  $name=$_POST['name'];
  $addr=$_POST['addr'];
  $post=$_POST['post'];
  $fox=$_POST['fox'];
  $type=$_POST['type'];
  $email=$_POST['email'];
  $tele=$_POST['tele'];
  $old=$_POST['old'];

  $sql="UPDATE t_dept SET  
  VC_DEPT_CODE = '$code',
  VC_DEPT_NAME = '$name',
  VC_LOCATION ='$addr',
  VC_POST_CODE='$post',
  VC_FAX='$fox',
  N_DEPT_TYPE=$type,
  VC_MAIL='$email',
  VC_TELEPHONE='$tele'
  WHERE N_DEPT_ID=$old";
  $res=mysqli_query($link, $sql, MYSQLI_ASYNC);
  if ($res) {
      echo "成功";
  } else {
      echo "Error";
  }
  mysqli_close($link);
}
function add(){

    $link = mysqli_connect('127.0.0.1','root','root','hr_database');
    if (!$link) {
        die("连接失败:".mysqli_connect_error());
    }
    $sql="select Max(N_DEPT_ID) from t_dept";
    $result = mysqli_query($link, $sql);
    $a=mysqli_fetch_array($result);
    $a[0]++;
    $link->query("SET NAMES utf8");                 //数据库增加操作
    if($_POST['addr']=="") $addr="\"".$_POST['addr']."\"";
    if($_POST['post']=="") $post="\"".$_POST['post']."\"";
    if($_POST['fox']=="") $fox="\"".$_POST['fox']."\"";
    if($_POST['email']=="") $email="\"".$_POST['email']."\"";
    if($_POST['tele']=="") $tele="\"".$_POST['tele']."\"";
    $code=$_POST['code'];
    $name=$_POST['name'];
    $type=$_POST['type'];
    $par=$_POST['par'];
    $sql="INSERT into t_dept values  ($a[0],'$code','$name',$type,$par,$addr,$post,$tele,$fox,$email,0,null)";
    $res=mysqli_query($link, $sql, MYSQLI_ASYNC);
    if ($res) {
        echo "成功";
    } else {
        echo "Error";
    }
    mysqli_close($link);
}
function dele()
{
    $link = mysqli_connect('127.0.0.1','root','root','hr_database');
    if (!$link) {
        die("连接失败:".mysqli_connect_error());
    }
    $a=$_GET['id'];
    $link->query("SET NAMES utf8");                 //数据库删除操作
    $sql ="SELECT N_DEPT_ID from t_dept where VC_DEPT_NAME ='".$a."'";
    $result = mysqli_query($link, $sql);
    $i=null;
    while($row = mysqli_fetch_row($result)){
        $i=$row[0];
    }
    $sql = "SELECT * FROM t_employee WHERE N_DEPT_ID=$i";
    $result=mysqli_query($link, $sql);
    while($row = mysqli_fetch_row($result)){
        echo "<script> alert('部门正在使用中!');window.location.href = \"welt_dept.php\";</script>";
        return;
    }
    $sql="DELETE from t_dept where N_DEPT_ID = $i";
    $res=mysqli_query($link, $sql);
    if ($res) {
        echo "成功";
    } else {
        echo "Error";
    }
    mysqli_close($link);
    header("location:welt_dept.php");
}
function show()
{
$q=$_GET["q"];

$con =mysqli_connect('127.0.0.1', 'root', 'root', 'hr_database');
if (!$con)
 {
    die("数据库连接失败:".mysqli_connect_error());
 }
 $con->query("SET NAMES utf8");
$sql="select * from t_dept where VC_DEPT_NAME = '".$q."'";
$result = mysqli_query( $con , $sql ); 
echo "<table class=\"table\">";
while($row = mysqli_fetch_array($result))
 {
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