<html>
<head>
    <script src="/static/js/fix.js"></script>
    <script src="/static/js/add_ajax.js"></script>
</head>
<body>
<div class="container-fluid" style="margin-top: 50px;">
    <table class="table table-hover table-bordered">
        <caption style="text-align: center;"><h2>模具列表</h2></caption>
        <tr>
            <th>模具编号</th>
            <th>厂商编号</th>
            <th>主要材料</th>
            <th>长度、宽度、合模高度/mm</th>
            <th>模具总重量/吨</th>
            <th>上模重量/吨</th>
            <th>下模重量/吨</th>
            <th></th>
        </tr>
        <?php
        foreach($mould as $row)
        {
            echo '<tr>';
            echo '<td>'.$row['mouldNumber'].'</td>';
            echo '<td>'.$row['companyNumber'].'</td>';
            echo '<td>'.$row['materialNumber'].'</td>';
            echo '<td>'.($row['length'] / 10).' × '.($row['width'] / 10).' × '.($row['height'] / 10).'</td>';
            echo '<td>'.($row['totalWeight'] / 10).'</td>';
            echo '<td>'.($row['upperMoldWeight'] / 10).'</td>';
            echo '<td>'.($row['bottomMoldWeight'] / 10).'</td>';
            echo '<td>'.'<a data-toggle="modal" data-target="#fix" href="#" onclick="fixModule(this)">修改</a>'.'</td>';
        }
        ?>
    </table>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#fix" onclick="resetModuleModal(this)">
        添加新模具
    </button>

    <!--分页-->
    <?php echo $this->pagination->create_links(); ?>

    <!--模态框-->
    <div class="modal fade" id="fix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">模具信息修改</h4>
                </div>
                <div class="modal-body">
                    <form action="/index.php/others/fixMould" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="mouldNumber" class="col-sm-3 control-label">模具编号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="mouldNumber" name="mouldNumber" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="companyNumber" class="col-sm-3 control-label">厂商编号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="companyNumber" name="companyNumber" onfocus="showCompany()" required>
                            </div>
                            <!--显示厂商-->
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="showItSelf" id="showCompany" onclick="noCompanyModal()">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="materialNumber" class="col-sm-3 control-label">主要材料</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="materialNumber" name="materialNumber" onfocus="showMaterial()" required>
                            </div>
                            <!--显示材料-->
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="showItSelf" id="showMaterial" onclick="noMaterialModal()">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="length" class="col-sm-3 control-label">长度</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="length" name="length" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="width" class="col-sm-3 control-label">宽度</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="width" name="width" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="height" class="col-sm-3 control-label">高度</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="height" name="height" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="totalWeight" class="col-sm-3 control-label">模具总重量</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="totalWeight" name="totalWeight" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="upperMoldWeight" class="col-sm-3 control-label">上模重量</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="upperMoldWeight" name="upperMoldWeight" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bottomMoldWeight" class="col-sm-3 control-label">下模重量</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="bottomMoldWeight" name="bottomMoldWeight" required>
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