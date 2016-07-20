<html>
<head>
    <script src="/static/js/fix.js"></script>
    <script src="/static/js/add_ajax.js"></script>
</head>
<body>
    <div class="container-fluid" style="margin-top: 50px;">
        <table class="table table-hover table-bordered">
            <caption style="text-align: center;"><h2>材料列表</h2></caption>
            <tr>
                <th>材料编号</th>
                <th>厂商编号</th>
                <th>化学成分</th>
                <th>进厂重量/吨</th>
                <th>长度、宽度、厚度/mm</th>
                <th>保质期/天</th>
                <th>操作</th>
            </tr>
            <?php
            foreach($material as $row)
            {
                echo '<tr>';
                echo '<td>'.$row['materialNumber'].'</td>';
                echo '<td>'.$row['companyNumber'].'</td>';
                echo '<td>'.$row['chemicalComponents'].'</td>';
                echo '<td>'.($row['comingWeight'] / 10).'</td>';
                echo '<td>'.($row['length'] / 10).' × '.($row['width'] / 10).' × '.($row['thickness'] / 10).'</td>';
                echo '<td>'.$row['shelfLife'].'</td>';
                echo '<td>'.'<a data-toggle="modal" data-target="#fix" href="#" onclick="fixMaterial(this)">修改</a>'.'</td>';
            }
            ?>
        </table>

        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#fix" onclick="resetMaterialModal(this)">
            添加新材料
        </button>

        <!-- 分页 -->
        <?php
            echo $this->pagination->create_links();
        ?>

        <!--模态框-->
        <div class="modal fade" id="fix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">材料信息修改</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/index.php/others/fixMaterial" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="materialNumber" class="col-sm-3 control-label">材料编号</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="materialNumber" name="materialNumber" required>
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
                                <label for="chemicalComponents" class="col-sm-3 control-label">化学成分</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="chemicalComponents" name="chemicalComponents" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comingWeight" class="col-sm-3 control-label">进厂重量</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="comingWeight" name="comingWeight" required>
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
                                <label for="thickness" class="col-sm-3 control-label">厚度</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="thickness" name="thickness" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shelfLife" class="col-sm-3 control-label">保质期</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="shelfLife" name="shelfLife" required>
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