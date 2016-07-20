<html>
<head>
    <script src="/static/js/fix.js"></script>
</head>
<body>
<div class="container-fluid" style="margin-top: 50px;">
    <table class="table table-hover table-bordered">
        <caption style="text-align: center"><h2>设备列表</h2></caption>
        <tr>
            <th>设备编号</th>
            <th>设备名称</th>
            <th>设备描述</th>
            <th>备注</th>
            <th></th>
        </tr>
        <?php
        foreach($equipment as $row)
        {
            echo '<tr>';
            echo '<td>'.$row['equipmentNumber'].'</td>';
            echo '<td>'.$row['equipmentName'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            echo '<td>'.$row['remark'].'</td>';
            echo '<td>'.'<a data-toggle="modal" data-target="#fix" href="#" onclick="fixEquipment(this)">修改</a>'.'</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>

<!--模态框-->
<div class="modal fade" id="fix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">设备信息修改</h4>
            </div>
            <div class="modal-body">
                <form action="/index.php/Others/fixEquipment" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="equipmentNumber" class="col-sm-3 control-label">设备编号</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="equipmentNumber" name="equipmentNumber" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="equipmentName" class="col-sm-3 control-label">设备名称</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="equipmentName" name="equipmentName" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">设备描述</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remark" class="col-sm-3 control-label">备注</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="remark" name="remark">
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
</body>
</html>