<?php
//开启Session
session_start();
header("Content-type:text/html;charset=utf-8");
$link = mysqli_connect('127.0.0.1','root','root','hr_database');
//$link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
if (!$link) {
    die("连接失败:".mysqli_connect_error());
}
// 接受提交过来的用户名及密码
$username = $_POST["username"];//用户名
$password = $_POST["password"];//密码
if($username == "")
{
    //echo "请填写用户名<br>";
    echo"<script type='text/javascript'>alert('请填写用户名');location='login.html'; </script>";
}
if($password == "")
{
    //echo "请填写密码<br><a href='login.html'>返回</a>";
    echo"<script type='text/javascript'>alert('请填写密码');location='login.html';</script>";
}
$sql = "SELECT * FROM userinfo where id='{$username}' and passwd='{$password}';";
$result = mysqli_query($link, $sql);
$rows = mysqli_fetch_array($result);
if($rows) {
    //拿着提交过来的用户名和密码去数据库查找，看是否存在此用户名以及其密码
    echo "<script type='text/javascript'>location='homepage.php';</script>";

    setcookie('user');
}else {
    //echo "用户名或者密码错误<br>";
    echo "<script type='text/javascript'>alert('用户名或者密码错误');location='login.html';</script>";
    //echo "<a href='login.html'>返回</a>";
}
mysqli_close($link);
?>