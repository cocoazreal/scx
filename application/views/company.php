<html>
<head>
    <script src="/static/js/fix.js"></script>
</head>
<body>
<div class="container-fluid" style="margin-top: 50px;">
    <table class="table table-hover table-bordered">
        <caption style="text-align: center;"><h2>厂商列表</h2></caption>
        <tr>
            <th>厂商编号</th>
            <th>单位名称</th>
            <th>地址</th>
            <th>联系人姓名</th>
            <th>联系电话</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($company as $row)
        {
            echo '<tr>';
            echo '<td>'.$row['companyNumber'].'</td>';
            echo '<td>'.$row['companyName'].'</td>';
            echo '<td>'.$row['address'].'</td>';
            echo '<td>'.$row['contacts'].'</td>';
            echo '<td>'.$row['telephone'].'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>'.'<a data-toggle="modal" data-target="#fix" href="#" onclick="fixCompany(this)">修改</a>'.'</td>';
        }
        ?>
    </table>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#fix" onclick="resetCompanyModal(this)">
        添加新厂商
    </button>

    <!--分页-->
    <?php echo $this->pagination->create_links(); ?>

    <!--模态框-->
    <div class="modal fade" id="fix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">厂商信息修改</h4>
                </div>
                <div class="modal-body">
                    <form action="/index.php/others/fixCompany" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="companyNumber" class="col-sm-3 control-label">厂商编号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="companyNumber" name="companyNumber" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="companyName" class="col-sm-3 control-label">单位名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="companyName" name="companyName" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contacts" class="col-sm-3 control-label">联系人</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contacts" name="contacts" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">联系电话</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="telephone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">邮箱</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary col-sm-offset-6 col-sm-2">保存</button>
                            <button type="button" class="btn btn-default col-sm-offset-1 col-sm-2" data-dismiss="modal">关闭</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>