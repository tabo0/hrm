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
    <style>
        body * {margin: 0;padding: 0;}
        div.text {text-align:center}
        div.container {
            position: relative;
            width:600px;
            left: 120px;
            float:left;
        }
        div.button {
            position: relative;
            width:600px;
            left: 240px;
            top:80px;
            float:left;
        }
    </style>
</head>

<body background="../images/bk.jpg" id="list">
<div class="text"><h1 class="newcenter"> 查询统计</h1></div>
<div class="container">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="1-30字符">
                </div>
            </div>
        </form>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">性别</label>
                <div class="col-sm-10">
                    <select class="form-control" id="sex">
                        <option value="0">男</option>
                        <option value="1">女</option>
                    </select>
                </div>
            </div>
        </form>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">职称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" placeholder="1-30字符">
                </div>
            </div>
        </form>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">出生日期</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="date" >
                </div>
            </div>
        </form>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">健康状况</label>
                <div class="col-sm-10">
                    <select class="form-control" id="heal">
                        <option value="1">良好</option>
                        <option value="2">健康</option>
                        <option value="3">一般</option>
                        <option value="4">有慢性疾病</option>
                    </select>
                </div>
            </div>
        </form>
</div>
<div class="container">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">员工号</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="code" placeholder="1-30字符">
                </div>
            </div>
        </form>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">部门</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="dept" placeholder="1-30字符">
                </div>
            </div>
        </form>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">岗位</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="post" placeholder="1-30字符">
                </div>
            </div>
        </form>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">学历</label>
                <div class="col-sm-10">
                <select class="form-control" id="edu">
                        <option value="1">高中</option>
                        <option value="2">专科</option>
                        <option value="3">本科</option>
                        <option value="4">硕士</option>
                        <option value="5">博士</option>
                    </select>
                </div>
            </div>
        </form>
</div>
<div class="button">
    <button type="submit" class="btn btn-default" onclick="return submit()">查询</button>
    
</div>
</div>
<script>
        function  submit(){
            var code = $('#code').val();
            var name = $('#name').val();
            var sex = $('#sex').val();
            var title = $('#title').val();
            var date = $('#date').val();
            var heal = $('#heal').val();
            var dept = $('#dept').val();
            var edu = $('#edu').val();
            var post = $('#post').val();
            var con = {
                code: code,
                name: name,
                sex: sex,
                date: date,
                title: title,
                heal: heal,
                dept: dept,
                edu: edu,
                post: post,
            };
            $.get('que_list.php', con, function (data) { $("#list").html(data)});
    }
    </script>

</body>

</html>
