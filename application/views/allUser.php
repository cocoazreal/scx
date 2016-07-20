<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="生产线在线管理系统">
    <meta name="author" content="Kuan.C">
    <link rel="icon" href="">
    <title></title>
    <!--<link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="/static/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/static/css/Validform_v5.3.2.css">
    <script src="/static/js/jquery-1.11.3.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <script src="/static/js/fix.js"></script>
    <script src="/static/js/Validform_v5.3.2_min.js"></script>
</head>
<body>
  <!--所有用户信息-->
  <div class="container">
      <table class="table table-hover table-bordered">
          <caption><h2 style="text-align: center">用户列表</h2></caption>
          <tr>
              <th width="80px">工号</th>
              <th width="80px">用户名</th>
              <th width="80px">用户组</th>
              <th width="120px">部门</th>
              <th width="150px">电话</th>
              <th width="80px">是否可用</th>
              <th width="80px">操作</th>
              <th>备注</th>
          </tr>
          <?php
          foreach($allUserData as $row)
          {
              echo '<tr>';
              echo '<td>'.$row['account'].'</td>';
              echo '<td>'.$row['name'].'</td>';
              echo '<td>'.$row['userGroup'].'</td>';
              echo '<td>'.$row['department'].'</td>';
              echo '<td>'.$row['telephone'].'</td>';
              echo '<td>'.($row['usable'] == 'Y' ? '可用' : '不可用').'</td>';
              echo '<td>'.'<a data-toggle="modal" data-target="#myModal" href="#" onclick="fixPerson(this)">修改</a>'.'</td>';
              echo '<td>'.$row['remark'].'</td>';
              echo '</tr>';
          }
          ?>
      </table>
  </div>
  <div class="container">
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="resetPersonModal(this)">
          添加新用户
      </button>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">添加新用户</h4>
                  </div>
                  <div class="modal-body">
                      <form action="/index.php/home/insertNewUser" method="post" class="form-horizontal">
                          <div class="form-group">
                              <label for="account" class="col-sm-2 control-label">用户编号</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" id="account" name="account"  datatype="n4-4" errormsg="用户编号必须是4位数字！">
                              </div>
                              <div class="col-sm-5"></div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-2 control-label">用户名</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" id="name" name="name"  datatype="zh2-4|s2-30" errormsg="请填写正确的姓名！">
                              </div>
                              <div class="col-sm-5"></div>
                          </div>
                          <div class="form-group">
                              <label for="usergroup" class="col-sm-2 control-label">用户组</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" id="usergroup" name="usergroup" datatype="n1-2" errormsg="用户组必须是1-2位数字！">
                              </div>
                              <div class="col-sm-5"></div>
                          </div>
                          <div class="form-group">
                              <label for="password" class="col-sm-2 control-label">密码</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" id="password" name="password"  datatype="*4-8" errormsg="密码必须是4-8位字符！">
                              </div>
                              <div class="col-sm-5"></div>
                          </div>
                          <div class="form-group">
                              <label for="department" class="col-sm-2 control-label">部门</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" id="department" name="department"  datatype="n4-4" errormsg="部门必须是4位数字！">
                              </div>
                              <div class="col-sm-5"></div>
                          </div>
                          <div class="form-group">
                              <label for="telephone" class="col-sm-2 control-label">电话</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" id="telephone" name="telephone"  datatype="m" errormsg="请填写手机号码！" >
                              </div>
                              <div class="col-sm-5"></div>
                          </div>
                          <div class="form-group">
                              <label for="usable" class="col-sm-2 control-label">是否可用</label>
                              <div class="col-sm-5">
                                  <select class="form-control" id="usable" name="usable">
                                    <option value="Y">可用</option>
                                    <option value="N">不可用</option>
                                  </select>
                              </div>
                              <div class="col-sm-5"></div>
                          </div>
                          <div class="form-group">
                              <label for="remark" class="col-sm-2 control-label">备注</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" id="remark" name="remark">
                              </div>
                              <div class="col-sm-5"></div>
                          </div>
                          <div class="form-group">
                              <button type="button" class="btn btn-default col-sm-offset-3 col-sm-2" data-dismiss="modal">关闭</button>
                              <button type="submit" class="btn btn-primary col-sm-offset-2 col-sm-2">保存</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script type="text/javascript">
  $(".form-horizontal").Validform({
    tiptype:2,
    datatype:{
      "zh2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
    },
  });
  </script>
</body>
</html>