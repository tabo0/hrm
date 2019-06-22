<?php
    $info = $_GET;
    if($info['code']=="") $code=true; else $code="VC_EMP_CODE=\"".$info['code']."\"";
    if($info['name']=="") $name=true; else $name="VC_EMP_NAME=\"".$info['name']."\"";
    if($info['sex']=="") $sex=true; else $sex="N_GENDER=".$info['sex'];
    if($info['date']=="") $date=true; else $date="D_BIRTHDAY=".$info['date'];
    if($info['title']=="") $title=true; else $title="t_employee.N_TITLE_ID=".$info['title'];
    if($info['heal']=="") $heal=true; else $heal="N_HEALTH=".$info['heal'];
    if($info['dept']=="") $dept=true; else $dept="t_employee.N_DEPT_ID=\"".$info['dept'];
    if($info['edu']=="") $edu=true; else $edu="N_EDU_LEVEL=".$info['edu'];
    if($info['post']=="") $post=true; else $post="t_employee.N_POST_ID=".$info['post'];
    $link = mysqli_connect('127.0.0.1','root','root','hr_database');
    if (!$link) {
        die("数据库连接失败:".mysqli_connect_error());
    }
    $link->query("SET NAMES utf8");
    $sql = "SELECT * ,VC_DEPT_NAME,VC_TITLE_NAME,VC_POST_NAME
    FROM t_employee,t_dept,t_title,t_post
    WHERE $sex 
    AND $code
    AND $date
    AND $title
    AND $heal
    AND $dept
    AND $edu
    AND $post
    AND $name
    AND t_employee.N_TITLE_ID=t_title.N_TITLE_ID
    AND t_employee.N_POST_ID=t_post.N_POST_ID
    AND t_employee.N_DEPT_ID=t_dept.N_DEPT_ID";

    $result = mysqli_query($link, $sql);
    $gender=['男','女'];
    echo '<div class="text"><h1 class="newcenter"> 查询统计</h1></div>';
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
?>
