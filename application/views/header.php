<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="生产线管理系统">
  <meta name="author" content="Kuan.C">
  <title>生产线管理系统</title>
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">
  <link rel="stylesheet" href="/static/css/non-responsive.css">
  <link rel="stylesheet" href="/static/css/index.css">
  <link rel="stylesheet" href="/static/css/Validform_v5.3.2.css">
  <script src="/static/js/jquery-1.11.3.min.js"></script>
  <script src="/static/js/bootstrap.min.js"></script>
  <script src="/static/js/ScrollFixed.js"></script>
  <script src="/static/js/Validform_v5.3.2_min.js"></script>
</head>
<body>
  <!--导航条-->
  <nav class="navbar navbar-default navbar-fixed-top" id="nav">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="/index.php/home">生产线管理</a>
      </div>
      <div id="navbar">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">加热炉 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/index.php/MultilayerFurnaces/getNowData">当前状态</a></li>
              <li><a href="/index.php/MultilayerFurnaces">历史状态</a></li>
              <li><a href="/index.php/MultilayerFurnaces/showStat">统计</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">产品零件 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/index.php/production/allPart">零件列表</a></li>
              <li><a href="/index.php/production/showStat">生产统计</a></li>
              <li><a href="/index.php/production/showAllProduct">产品</a></li>
              <li><a href="/index.php/production/showAllProcess">工艺</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">辅助 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/index.php/others/showAllMaterial">材料</a></li>
              <li><a href="/index.php/others/showAllMould">模具</a></li>
              <li><a href="/index.php/others/showAllCompany">厂商</a></li>
              <li><a href="/index.php/others/showAllEquipment">设备</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">故障 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/index.php/alarm/allAlarm">故障类型</a></li>
              <li><a href="/index.php/alarm/showAllAlarm">故障列表</a></li>
              <li><a href="/index.php/alarm/showAlarmStat">故障统计</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">系统操作 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/index.php/SystemOperation/getAllOperation">操作类型</a></li>
              <li><a href="/index.php/SystemOperation/getAllOperationRecord">操作记录</a></li>
              <li><a href="/index.php/SystemOperation/getDoorRecord">安全门统计</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">帮助 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">帮助文档</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="header"><a href="#" data-target="#user"data-toggle="modal" id="username"><?=$name?></a></li>
          <li class="header" <?php if($usergroup !=12 ){echo 'style="display: none"';} ?> ><a href="/index.php/home/showAllUser" target="_blank">用户列表</a></li>
          <li class="header"><a href="/index.php/login" target="_self">退出登录</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--个人信息的模态框-->
  <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="user">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="user">个人信息</h4>
        </div>
        <div class="modal-body">
          <form action="http://www.scx.com/index.php/home/fixInfo" method="post" class="form-horizontal">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">用户名</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="name" name="name" datatype="zh2-4|s2-30" errormsg="请填写正确的姓名！">
              </div>
              <div class="col-sm-5"></div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-2 control-label">密码</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" id="password" name="password" datatype="*4-8">
              </div>
              <div class="col-sm-5"></div>
            </div>
            <div class="form-group">
              <label for="department" class="col-sm-2 control-label">部门</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="department" name="department" value="<?=$department ?>" datatype="n4-8" errormsg="填写部门编号">
              </div>
              <div class="col-sm-5"></div>
            </div>
            <div class="form-group">
              <label for="telephone" class="col-sm-2 control-label">电话</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?=$telephone ?>" datatype="m" errormsg="请填写手机号码！">
              </div>
              <div class="col-sm-5"></div>
            </div>
            <div class="form-group">
              <label for="usergroup" class="col-sm-2 control-label">用户组</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="usergroup" name="usergroup" value="<?=$usergroup ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="account" class="col-sm-2 control-label">用户编号</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="account" name="account" value="<?=$account ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="createtime" class="col-sm-2 control-label">加入时间</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="createtime" value="<?=$createtime ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-default col-sm-offset-1 col-sm-2" data-dismiss="modal" >关闭</button>
              <button type="submit" class="btn btn-primary col-sm-offset-1 col-sm-2" id="btn-save">修改</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <span class="alert-info">修改后需重新登录</span>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  $('#nav').scrollFixed({fixed:'left'});
  $(function(){
    $(".form-horizontal").Validform({
      tiptype:2,
      datatype:{
        "zh2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
      }
    });
  });
  // 个人信息模态框显示时执行此处函数，重置模态框中的用户名，防止浏览器自动填写登录时记录的用户工号。
  $('#user').on('show.bs.modal', function (e) {
    $('#name').val(name);
  });
  </script>
  <?php
  // 将name变量的值赋给JavaScript的变量。
  echo "<script type='text/javascript'>
        var name = '$name';
        </script>";
  ?>
</body>
</html>