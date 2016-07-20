<!DOCTYPE html>
<html lang="zh-CN"><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="生产线在线管理系统">
  <meta name="author" content="Kuan.C">
  <link rel="icon" href="">

  <title>生产线管理系统</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../static/css/bootstrap.min.css"/>
</head>
<body>

<div class="container" style="margin-top: 200px;">
    <h2 id="title" class="text-center">生产线管理系统 <small id="small">--登录</small></h2>
  <div class="row">
    <div class="col-md-offset-4 col-md-4 col-xs-offset-1 col-xs-10" id="login-dev">
      <form class="form" method="post" action="/home">

        <div class="form-group">
            <span class="glyphicon glyphicon-user logo" aria-hidden="true" style="float:left;width:10%;line-height: 34px;"></span>
            <label for="account" class="sr-only">用户工号</label>
            <input type="text" id="account" class="form-control input" placeholder="用户工号" name="account" required="" autofocus="" style="float:left;width: 90%;">
        </div>
          <br/>
        <div class="form-group">
            <span class="glyphicon glyphicon-lock logo" style="float:left;width:10%;line-height: 34px;"></span>
            <label for="inputPassword" class="sr-only">密码</label>
            <input type="password" id="inputPassword" class="form-control input" name="password" placeholder="密码" required="" style="float:left;width: 90%;">
        </div>
        <div class="form-group">
          <div class="checkbox" id="check">
            <label>
              <input type="checkbox" value="remember-me"> 记住密码
            </label>
            <span class="pull-right alert-info">初次登录请联系管理员</span>
          </div>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>