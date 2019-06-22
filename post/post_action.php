<?php
function show_rank(){
    class people{
        public $name = '';
        public $num = 0;
        public $time = 0;
        public $problem;
        public $is_first;
        public $start='2019-03-15 21:30:15';
        public $end='2019-03-15 23:30:15';
        public $n=0;
        function __construct($s,$e,$n) {
            $this->start=$s;
            $this->end=$e;
            $this->n=$n;
            for($i=1;$i<=$n;$i++){
                $this->problem[$i]=0;
                $this->is_first[$i]=0;
            }
        }
        public function  set($x,$f){
            if($f) $this->is_first[$x['num']]=$f;
            date_default_timezone_set('PRC');
            $start_famate_time = strtotime($this->start);//开始时间转化为时间戳
            $end_famate_time = strtotime($this->end); //结束时间转化为时间戳
            $now_time = strtotime($x['time']);//结束时间转化为时间戳
            $this->name=$x['id'];
            if(!$this->problem[$x['num']]){
                $this->problem[$x['num']]=0;
            }
            if($x['answer']=='Accepted'){
                if($this->problem[$x['num']]<0){
                    $this->problem[$x['num']]=-$this->problem[$x['num']];
                    if($end_famate_time >= $now_time  && $start_famate_time <= $now_time){
                        $this->time+=floor(($now_time-$start_famate_time )/60);
                    }
                    $this->num++;
                }
                else if($this->problem[$x['num']]==0){
                    $this->problem[$x['num']]=9999999;
                    if($end_famate_time >= $now_time  && $start_famate_time <= $now_time){
                        $this->time+=floor(($now_time-$start_famate_time )/60);
                    }
                    $this->num++;
                }
            }
            else if($x['answer']!='Judging...'){
                if($this->problem[$x['num']]<=0){
                    $this->problem[$x['num']]=$this->problem[$x['num']]-1;
                    //echo $start_famate_time.'<'.$now_time.'<'.$end_famate_time.'bug';
                    if($end_famate_time >= $now_time  and $start_famate_time <= $now_time){
                        $this->time+=20;
                    }
                }
            }
        }
    }
    $start_time=$_GET['start_time'];
    $end_time=$_GET['end_time'];
    $problem=$_GET['problem'];
    //$link = mysqli_connect('127.0.0.1','root','root','wangz_23558894_user');
    $link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("&#36830;&#25509;&#22833;&#36133;:".mysqli_connect_error());
    }
    $context=$_GET["context"];
    $sql ="select * from status where context= $context  order by time ASC;";
    $result = mysqli_query($link, $sql);
    $n=0;
    $mp=array();
    $mp1=array();
    $first=array();
    $p=array();
    $sum=count(explode(",",$problem));
    while($arr=mysqli_fetch_array($result)){

        $f=0;
        if(strcmp($start_time,$arr['time'])>0||strcmp($end_time,$arr['time'])<0) continue;
        if(!in_array($arr['num'],$first) and $arr['answer']=='Accepted'){
            $f=1;
            array_push($first,$arr['num']);
        }
        if(in_array($arr['id'],$mp)){
            $id=$mp1[$arr['id']];
            $p[$id]->set($arr,$f);
        }else{
            //echo "2";
            $mp[++$n]=$arr['id'];
            $mp1[$arr['id']]=$n;
            $id=$n;
            $p[$id]=new people($start_time,$end_time,$sum);
            $p[$id]->set($arr,$f);
            //echo $p[$id]->name;
        }
    }

    for($i=1;$i<=$n;$i++){
        for($j=$i+1;$j<=$n;$j++){
            if($p[$i]->num<$p[$j]->num || ($p[$i]->num==$p[$j]->num &&$p[$i]->time>$p[$j]->time)){
                $tp=clone $p[$i];
                $p[$i]=$p[$j];
                $p[$j]=$tp;
            }
        }
    }
    echo ' <thead>
 <tr >
<th>排名</th>
<th>昵称</th>
<th>通过题数</th>
<th>罚时</th>';
    for($i=1;$i<=$sum;$i++) {
        echo "<th>$i</th>";
    }
    echo '</tr>
</thead>
<tbody>';
    for($i=1;$i<=$n;$i++){
        if(isset($_COOKIE['user'])&&$_COOKIE['user']===$p[$i]->name) $userbk="style='background:lightblue'";
        else $userbk='';
        echo " <tr >
    <td $userbk>$i</td>
    <td $userbk>{$p[$i]->name}</td>
    <td $userbk>{$p[$i]->num}</td>
    <td $userbk>{$p[$i]->time}</td>
        ";
        for($j=1;$j<=$sum;$j++){
            //echo $p[$i]->is_first[$j];
            $tp=$p[$i]->problem[$j];
            if($tp<0) $x="<td style=\"background:red\">$tp</td>";
            else if($tp>0){
                if($p[$i]->is_first[$j]) $bk='green';
                else $bk='lawngreen';
                if($tp==9999999) $x="<td style=\"background:$bk\"></td>";
                else $x="<td style=\"background:$bk\">-$tp</td>";
            }
            else $x="<td></td>";
            echo $x;
        }
        echo '</tr>';

    }
    echo '</tbody>';
    mysqli_close($link);
}
function show_status(){
// $link = mysqli_connect('127.0.0.1','root','root','wangz_23558894_user');
    $link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("&#36830;&#25509;&#22833;&#36133;:".mysqli_connect_error());
    }
    $context=$_GET["context"];

    $sql = 'select * from status where context='. $context.' order by time DESC LIMIT 20;';

    $result = mysqli_query($link, $sql);

    while($arr=mysqli_fetch_row($result)){//&#21462;&#20986;&#34920;study_sql&#20013;&#30340;&#25152;&#26377;&#32467;&#26524;&#38598;
        if(isset($_COOKIE['user'])&& reset($arr)===$_COOKIE['user']) echo '<tr style="background:lavender">';
        else echo '<tr>';
        //foreach($arr as $col){//&#36941;&#21382;&#25968;&#25454;
        for($i=0;$i<(count($arr)-1);$i++){
            $col=$arr[$i];
            if($col=='Accepted')echo '<td><span style="color: #00FF33">Accepted</span></td>';
            else if($col=='Wrong Answer')echo '<td><span style="color:red">Wrong Answer</span></td>';
            else if($col=='Judging...')echo '<td><span style="color:black">Judging...</span></td>';
            else echo '<td>'.$col.'</td>';
        }
        echo "</tr>";
    }
    mysqli_close($link);
}
function insert(){
    //$link = mysqli_connect('127.0.0.1','root','root','wangz_23558894_user');
    $link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("连接失败:".mysqli_connect_error());
    }
    $sql="select Max(id) from problem";
    $result = mysqli_query($link, $sql);
    $a=mysqli_fetch_array($result);
    $a[0]++;
// echo $a[0];
    $name=$_POST['name'];
    $dec =$_POST['dec'];
    $input = $_POST['input'];
    $output = $_POST['output'];
    $sampleinput =$_POST['sampleinput'];
    $sampleoutput = $_POST['sampleoutput'];
    $stdin = $_POST['stdin'];
    $stdout = $_POST['stdout'];
    $sql="insert into problem values ($a[0],'$name','$dec','$input','$output','$sampleinput','$sampleoutput','$stdin','$stdout',0);";
    //echo $sql;
    $res=mysqli_query($link, $sql, MYSQLI_ASYNC);
    if ($res) {
        echo "成功";
    } else {
        echo "Error";
    }
    mysqli_close($link);
}
function show_rank1(){
    class people{
        public $name = '';
        public $num = 0;
        public $time = 0;
        public $problem;
        public $is_first;
        public $start='2019-03-15 21:30:15';
        public $end='2019-03-15 23:30:15';
        public $n=0;
        function __construct($s,$e,$n) {
            $this->start=$s;
            $this->end=$e;
            $this->n=$n;
            for($i=1;$i<=$n;$i++){
                $this->problem[$i]=0;
                $this->is_first[$i]=0;
            }
        }
        public function  set($x,$f){
            if($f) $this->is_first[$x['num']]=$f;
            date_default_timezone_set('PRC');
            $start_famate_time = strtotime($this->start);//开始时间转化为时间戳
            $end_famate_time = strtotime($this->end); //结束时间转化为时间戳
            $now_time = strtotime($x['time']);//结束时间转化为时间戳
            $this->name=$x['id'];
            if(!$this->problem[$x['num']]){
                $this->problem[$x['num']]=0;
            }
            if($x['answer']=='Accepted'){
                if($this->problem[$x['num']]<0){
                    $this->problem[$x['num']]=-$this->problem[$x['num']];
                    if($end_famate_time >= $now_time  && $start_famate_time <= $now_time){
                        $this->time+=floor(($now_time-$start_famate_time )/60);
                    }
                    $this->num++;
                }
                else if($this->problem[$x['num']]==0){
                    $this->problem[$x['num']]=9999999;
                    if($end_famate_time >= $now_time  && $start_famate_time <= $now_time){
                        $this->time+=floor(($now_time-$start_famate_time )/60);
                    }
                    $this->num++;
                }
            }
            else if($x['answer']!='Judging...'){
                if($this->problem[$x['num']]<=0){
                    $this->problem[$x['num']]=$this->problem[$x['num']]-1;
                    //echo $start_famate_time.'<'.$now_time.'<'.$end_famate_time.'bug';
                    if($end_famate_time >= $now_time  and $start_famate_time <= $now_time){
                        $this->time+=20;
                    }
                }
            }
        }
    }
    $start_time=$_GET['start_time'];
    $end_time=$_GET['end_time'];
    $problem=$_GET['problem'];
    //$link = mysqli_connect('127.0.0.1','root','root','wangz_23558894_user');
    $link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("&#36830;&#25509;&#22833;&#36133;:".mysqli_connect_error());
    }
    $context=$_GET["context"];
    $sql ="select * from status where context= $context  order by time ASC;";
    $result = mysqli_query($link, $sql);
    $n=0;
    $mp=array();
    $mp1=array();
    $first=array();
    $p=array();
    $sum=count(explode(",",$problem));
    while($arr=mysqli_fetch_array($result)){

        $f=0;
        if(strcmp($start_time,$arr['time'])>0||strcmp($end_time,$arr['time'])<0) continue;
        if(!in_array($arr['num'],$first) and $arr['answer']=='Accepted'){
            $f=1;
            array_push($first,$arr['num']);
        }
        if(in_array($arr['id'],$mp)){
            $id=$mp1[$arr['id']];
            $p[$id]->set($arr,$f);
        }else{
            //echo "2";
            $mp[++$n]=$arr['id'];
            $mp1[$arr['id']]=$n;
            $id=$n;
            $p[$id]=new people($start_time,$end_time,$sum);
            $p[$id]->set($arr,$f);
            //echo $p[$id]->name;
        }
    }

    for($i=1;$i<=$n;$i++){
        for($j=$i+1;$j<=$n;$j++){
            if($p[$i]->num<$p[$j]->num || ($p[$i]->num==$p[$j]->num &&$p[$i]->time>$p[$j]->time)){
                $tp=clone $p[$i];
                $p[$i]=$p[$j];
                $p[$j]=$tp;
            }
        }
    }
    echo ' <thead>
 <tr >
<th>排名</th>
<th>昵称</th>
<th>通过题数</th>
<th>罚时</th>';
    for($i=1;$i<=$sum;$i++) {
        echo "<th>$i</th>";
    }
    echo '</tr>
</thead>
<tbody>';
    for($i=1;$i<=$n;$i++){
        if(isset($_COOKIE['user'])&&$_COOKIE['user']===$p[$i]->name) $userbk="style='background:lightblue'";
        else $userbk='';
        echo " <tr >
    <td $userbk>$i</td>
    <td $userbk>{$p[$i]->name}</td>
    <td $userbk>{$p[$i]->num}</td>
    <td $userbk>{$p[$i]->time}</td>
        ";
        for($j=1;$j<=$sum;$j++){
            //echo $p[$i]->is_first[$j];
            $tp=$p[$i]->problem[$j];
            if($tp<0) $x="<td style=\"background:red\">$tp</td>";
            else if($tp>0){
                if($p[$i]->is_first[$j]) $bk='green';
                else $bk='lawngreen';
                if($tp==9999999) $x="<td style=\"background:$bk\"></td>";
                else $x="<td style=\"background:$bk\">-$tp</td>";
            }
            else $x="<td></td>";
            echo $x;
        }
        echo '</tr>';

    }
    echo '</tbody>';
    mysqli_close($link);
}
function show_status1(){
// $link = mysqli_connect('127.0.0.1','root','root','wangz_23558894_user');
    $link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("&#36830;&#25509;&#22833;&#36133;:".mysqli_connect_error());
    }
    $context=$_GET["context"];

    $sql = 'select * from status where context='. $context.' order by time DESC LIMIT 20;';

    $result = mysqli_query($link, $sql);

    while($arr=mysqli_fetch_row($result)){//&#21462;&#20986;&#34920;study_sql&#20013;&#30340;&#25152;&#26377;&#32467;&#26524;&#38598;
        if(isset($_COOKIE['user'])&& reset($arr)===$_COOKIE['user']) echo '<tr style="background:lavender">';
        else echo '<tr>';
        //foreach($arr as $col){//&#36941;&#21382;&#25968;&#25454;
        for($i=0;$i<(count($arr)-1);$i++){
            $col=$arr[$i];
            if($col=='Accepted')echo '<td><span style="color: #00FF33">Accepted</span></td>';
            else if($col=='Wrong Answer')echo '<td><span style="color:red">Wrong Answer</span></td>';
            else if($col=='Judging...')echo '<td><span style="color:black">Judging...</span></td>';
            else echo '<td>'.$col.'</td>';
        }
        echo "</tr>";
    }
    mysqli_close($link);
}
function insert1(){
    //$link = mysqli_connect('127.0.0.1','root','root','wangz_23558894_user');
    $link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("连接失败:".mysqli_connect_error());
    }
    $sql="select Max(id) from problem";
    $result = mysqli_query($link, $sql);
    $a=mysqli_fetch_array($result);
    $a[0]++;
// echo $a[0];
    $name=$_POST['name'];
    $dec =$_POST['dec'];
    $input = $_POST['input'];
    $output = $_POST['output'];
    $sampleinput =$_POST['sampleinput'];
    $sampleoutput = $_POST['sampleoutput'];
    $stdin = $_POST['stdin'];
    $stdout = $_POST['stdout'];
    $sql="insert into problem values ($a[0],'$name','$dec','$input','$output','$sampleinput','$sampleoutput','$stdin','$stdout',0);";
    //echo $sql;
    $res=mysqli_query($link, $sql, MYSQLI_ASYNC);
    if ($res) {
        echo "成功";
    } else {
        echo "Error";
    }
    mysqli_close($link);
}
function show_rank2(){
    class people{
        public $name = '';
        public $num = 0;
        public $time = 0;
        public $problem;
        public $is_first;
        public $start='2019-03-15 21:30:15';
        public $end='2019-03-15 23:30:15';
        public $n=0;
        function __construct($s,$e,$n) {
            $this->start=$s;
            $this->end=$e;
            $this->n=$n;
            for($i=1;$i<=$n;$i++){
                $this->problem[$i]=0;
                $this->is_first[$i]=0;
            }
        }
        public function  set($x,$f){
            if($f) $this->is_first[$x['num']]=$f;
            date_default_timezone_set('PRC');
            $start_famate_time = strtotime($this->start);//开始时间转化为时间戳
            $end_famate_time = strtotime($this->end); //结束时间转化为时间戳
            $now_time = strtotime($x['time']);//结束时间转化为时间戳
            $this->name=$x['id'];
            if(!$this->problem[$x['num']]){
                $this->problem[$x['num']]=0;
            }
            if($x['answer']=='Accepted'){
                if($this->problem[$x['num']]<0){
                    $this->problem[$x['num']]=-$this->problem[$x['num']];
                    if($end_famate_time >= $now_time  && $start_famate_time <= $now_time){
                        $this->time+=floor(($now_time-$start_famate_time )/60);
                    }
                    $this->num++;
                }
                else if($this->problem[$x['num']]==0){
                    $this->problem[$x['num']]=9999999;
                    if($end_famate_time >= $now_time  && $start_famate_time <= $now_time){
                        $this->time+=floor(($now_time-$start_famate_time )/60);
                    }
                    $this->num++;
                }
            }
            else if($x['answer']!='Judging...'){
                if($this->problem[$x['num']]<=0){
                    $this->problem[$x['num']]=$this->problem[$x['num']]-1;
                    //echo $start_famate_time.'<'.$now_time.'<'.$end_famate_time.'bug';
                    if($end_famate_time >= $now_time  and $start_famate_time <= $now_time){
                        $this->time+=20;
                    }
                }
            }
        }
    }
    $start_time=$_GET['start_time'];
    $end_time=$_GET['end_time'];
    $problem=$_GET['problem'];
    //$link = mysqli_connect('127.0.0.1','root','root','wangz_23558894_user');
    $link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("&#36830;&#25509;&#22833;&#36133;:".mysqli_connect_error());
    }
    $context=$_GET["context"];
    $sql ="select * from status where context= $context  order by time ASC;";
    $result = mysqli_query($link, $sql);
    $n=0;
    $mp=array();
    $mp1=array();
    $first=array();
    $p=array();
    $sum=count(explode(",",$problem));
    while($arr=mysqli_fetch_array($result)){

        $f=0;
        if(strcmp($start_time,$arr['time'])>0||strcmp($end_time,$arr['time'])<0) continue;
        if(!in_array($arr['num'],$first) and $arr['answer']=='Accepted'){
            $f=1;
            array_push($first,$arr['num']);
        }
        if(in_array($arr['id'],$mp)){
            $id=$mp1[$arr['id']];
            $p[$id]->set($arr,$f);
        }else{
            //echo "2";
            $mp[++$n]=$arr['id'];
            $mp1[$arr['id']]=$n;
            $id=$n;
            $p[$id]=new people($start_time,$end_time,$sum);
            $p[$id]->set($arr,$f);
            //echo $p[$id]->name;
        }
    }

    for($i=1;$i<=$n;$i++){
        for($j=$i+1;$j<=$n;$j++){
            if($p[$i]->num<$p[$j]->num || ($p[$i]->num==$p[$j]->num &&$p[$i]->time>$p[$j]->time)){
                $tp=clone $p[$i];
                $p[$i]=$p[$j];
                $p[$j]=$tp;
            }
        }
    }
    echo ' <thead>
 <tr >
<th>排名</th>
<th>昵称</th>
<th>通过题数</th>
<th>罚时</th>';
    for($i=1;$i<=$sum;$i++) {
        echo "<th>$i</th>";
    }
    echo '</tr>
</thead>
<tbody>';
    for($i=1;$i<=$n;$i++){
        if(isset($_COOKIE['user'])&&$_COOKIE['user']===$p[$i]->name) $userbk="style='background:lightblue'";
        else $userbk='';
        echo " <tr >
    <td $userbk>$i</td>
    <td $userbk>{$p[$i]->name}</td>
    <td $userbk>{$p[$i]->num}</td>
    <td $userbk>{$p[$i]->time}</td>
        ";
        for($j=1;$j<=$sum;$j++){
            //echo $p[$i]->is_first[$j];
            $tp=$p[$i]->problem[$j];
            if($tp<0) $x="<td style=\"background:red\">$tp</td>";
            else if($tp>0){
                if($p[$i]->is_first[$j]) $bk='green';
                else $bk='lawngreen';
                if($tp==9999999) $x="<td style=\"background:$bk\"></td>";
                else $x="<td style=\"background:$bk\">-$tp</td>";
            }
            else $x="<td></td>";
            echo $x;
        }
        echo '</tr>';

    }
    echo '</tbody>';
    mysqli_close($link);
}
function show_status2(){
// $link = mysqli_connect('127.0.0.1','root','root','wangz_23558894_user');
    $link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("&#36830;&#25509;&#22833;&#36133;:".mysqli_connect_error());
    }
    $context=$_GET["context"];

    $sql = 'select * from status where context='. $context.' order by time DESC LIMIT 20;';

    $result = mysqli_query($link, $sql);

    while($arr=mysqli_fetch_row($result)){//&#21462;&#20986;&#34920;study_sql&#20013;&#30340;&#25152;&#26377;&#32467;&#26524;&#38598;
        if(isset($_COOKIE['user'])&& reset($arr)===$_COOKIE['user']) echo '<tr style="background:lavender">';
        else echo '<tr>';
        //foreach($arr as $col){//&#36941;&#21382;&#25968;&#25454;
        for($i=0;$i<(count($arr)-1);$i++){
            $col=$arr[$i];
            if($col=='Accepted')echo '<td><span style="color: #00FF33">Accepted</span></td>';
            else if($col=='Wrong Answer')echo '<td><span style="color:red">Wrong Answer</span></td>';
            else if($col=='Judging...')echo '<td><span style="color:black">Judging...</span></td>';
            else echo '<td>'.$col.'</td>';
        }
        echo "</tr>";
    }
    mysqli_close($link);
}
function insert2(){
    //$link = mysqli_connect('127.0.0.1','root','root','wangz_23558894_user');
    $link = mysqli_connect('sql202.wangzhan.gq','wangz_23558894','taobo123','wangz_23558894_user');
    if (!$link) {
        die("连接失败:".mysqli_connect_error());
    }
    $sql="select Max(id) from problem";
    $result = mysqli_query($link, $sql);
    $a=mysqli_fetch_array($result);
    $a[0]++;
// echo $a[0];
    $name=$_POST['name'];
    $dec =$_POST['dec'];
    $input = $_POST['input'];
    $output = $_POST['output'];
    $sampleinput =$_POST['sampleinput'];
    $sampleoutput = $_POST['sampleoutput'];
    $stdin = $_POST['stdin'];
    $stdout = $_POST['stdout'];
    $sql="insert into problem values ($a[0],'$name','$dec','$input','$output','$sampleinput','$sampleoutput','$stdin','$stdout',0);";
    //echo $sql;
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
    $sql="select Max(N_POST_ID) from t_post";
    $result = mysqli_query($link, $sql);
    $a=mysqli_fetch_array($result);
    $a[0]++;
    $name=$_POST['name'];
    $zige =$_POST['zige'];
    $zhize = $_POST['zhize'];
    $work = $_POST['work'];
    $father=$_POST['father'];
    $quanxian=$_POST['quanxian'];

    $rs = mysqli_query($link, "select N_POST_ID from t_post where VC_POST_NAME='$father';");
    $ans=mysqli_fetch_array($rs);
    if($ans) $father=$ans[0];
    else $father=0;


    $sql="insert into t_post values ($a[0],'$name',$father,'$zhize','$zige','$quanxian','$work');";
    $res=mysqli_query($link, $sql, MYSQLI_ASYNC);
    echo $sql;
    if ($res) {
        echo "成功";
    } else {
        echo "Error";
    }
    mysqli_close($link);
}
function delete(){
    $link = mysqli_connect('127.0.0.1','root','root','hr_database');
    if (!$link) {
        die("连接失败:".mysqli_connect_error());
    }
    $id=$_GET['id'];
    $sql="delete from t_post where N_POST_ID=$id";
    $res=mysqli_query($link, $sql, MYSQLI_ASYNC);
    if ($res) {
        echo "成功";
    } else {
        echo "Error";
    }
    mysqli_close($link);
    header("location:post_title.php");
}
function modify()
{
    $link = mysqli_connect('127.0.0.1', 'root', 'root', 'hr_database');
    if (!$link) {
        die("连接失败:" . mysqli_connect_error());
    }
    $name=$_POST['name'];
    $zige =$_POST['zige'];
    $zhize = $_POST['zhize'];
    $work = $_POST['work'];
    $father=$_POST['father'];
    $quanxian=$_POST['quanxian'];

    $rs = mysqli_query($link, "select N_POST_ID from t_post where VC_POST_NAME='$father';");
    $ans=mysqli_fetch_array($rs);
    if($ans) $father=$ans[0];
    else $father=0;

    $id = $_POST['id'];
    $sql = "UPDATE t_post SET VC_POST_NAME = '$name',N_PARENT_ID=$father ,VC_DUTY='$zhize',
    VC_QUALIFICATION='$zige',VC_PURVIEW='$quanxian' ,VC_WORK_CONTENT='$work' WHERE N_POST_ID = $id";
    $res = mysqli_query($link, $sql, MYSQLI_ASYNC);
    //echo $id;
    if ($res) {
        echo "成功";
    } else {
        echo "Error";
    }
}
if(isset($_POST['flag'])&&$_POST['flag']=='add') add();
else if(isset($_POST['flag'])&&$_POST['flag']=='modify') modify();
else if(isset($_GET['flag'])&&$_GET['flag']=='delete') delete();
?>
