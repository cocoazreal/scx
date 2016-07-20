<html>
<head>
    <link rel="stylesheet" href="/static/css/production.css">
    <script src="/static/js/fix.js"></script>
    <script src="/static/js/add_ajax.js"></script>
</head>
<body>
    <div class="container-fluid" style="margin-top: 50px;">
        <table class="table table-hover table-bordered" id="product_list">
            <caption style="text-align: center"><h2>产品列表</h2></caption>
            <tr>
                <th>产品型号</th>
                <th>产品名称</th>
                <th>材料编号</th>
                <th>模具编号</th>
                <th>厂商编号</th>
                <th>工艺编号</th>
                <th>长度、宽度、厚度/mm</th>
                <th width="100px">毛坯重量、最终重量/Kg</th>
                <th width="120px">屈服强度、抗拉强度/MPa</th>
                <th>延展率/%</th>
                <th width="230px">形位公差</th>
                <th>操作</th>
            </tr>
            <?php
                foreach($product as $row)
                {
                    echo '<tr>';
                    echo '<td rowspan="2">'.$row['productNumber'].'</td>';
                    echo '<td rowspan="2">'.$row['productName'].'</td>';
                    echo '<td rowspan="2">'.$row['materialNumber'].'</td>';
                    echo '<td rowspan="2">'.$row['mouldNumber'].'</td>';
                    echo '<td rowspan="2">'.$row['companyNumber'].'</td>';
                    echo '<td rowspan="2">'.$row['processNumber'].'</td>';
                    echo '<td rowspan="2">'.($row['length'] / 10).' × '.($row['width'] / 10).' × '.($row['thickness'] / 10).'</td>';
                    echo '<td>'.$row['blankWeight'] / 10 .'</td>';
                    echo '<td>'.$row['yieldStrength'] / 10 .'</td>';
                    echo '<td rowspan="2">'.$row['elongation'] / 10 .'</td>';
                    echo '<td rowspan="2">'.$row['geometricTolerances'].'</td>';
                    echo '<td rowspan="2">'.'<a data-toggle="modal" data-target="#fix" href="#" onclick="fixProduct(this)">修改</a>'.'</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>'.$row['productWeight'] / 10 .'</td>';
                    echo '<td>'.$row['tensileStrength'] / 10 .'</td>';
                    echo '</tr>';
                }
            ?>
        </table>

        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#fix" onclick="resetProductModal(this)">
            添加新产品
        </button>

        <!--分页-->
        <?php
        echo $this->pagination->create_links();
        ?>

        <!--模态框-->
        <div class="modal fade" id="fix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">产品信息修改</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/index.php/production/fixProduction" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="productNumber" class="col-sm-3 control-label">产品编号</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="productNumber" name="productNumber" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="productName" class="col-sm-3 control-label">产品名称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="productName" name="productName" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="materialNumber" class="col-sm-3 control-label">材料编号</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="materialNumber" name="materialNumber" onfocus="showMaterial()" required>
                                </div>
                                <!--显示材料-->
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="showItSelf" id="showMaterial" onclick="noModal()">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mouldNumber" class="col-sm-3 control-label">模具编号</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="mouldNumber" name="mouldNumber" onfocus="showMould()" required>
                                </div>
                                <!--显示模具-->
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="showItSelf" id="showMould" onclick="noModal()">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="companyNumber" class="col-sm-3 control-label">厂商编号</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="companyNumber" name="companyNumber" onfocus="showCompany()" required>
                                </div>
                                <!--显示厂商-->
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="showItSelf" id="showCompany" onclick="noModal()">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="processNumber" class="col-sm-3 control-label">工艺编号</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="processNumber" name="processNumber" onfocus="showProcess()" required>
                                </div>
                                <!--显示工艺-->
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="showItSelf" id="showProcess" onclick="noModal()">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="length" class="col-sm-3 control-label">产品长度</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="length" name="length" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="width" class="col-sm-3 control-label">产品宽度</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="width" name="width" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="thickness" class="col-sm-3 control-label">产品厚度</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="thickness" name="thickness" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="blankWeight" class="col-sm-3 control-label">毛坯重量</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="blankWeight" name="blankWeight" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="productWeight" class="col-sm-3 control-label">产品重量</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="productWeight" name="productWeight" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="yieldStrength" class="col-sm-3 control-label">屈服强度</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="yieldStrength" name="yieldStrength" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tensileStrength" class="col-sm-3 control-label">抗拉强度</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="tensileStrength" name="tensileStrength" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="elongation" class="col-sm-3 control-label">延展率</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="elongation" name="elongation" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="geometricTolerances" class="col-sm-3 control-label">形位公差</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="geometricTolerances" name="geometricTolerances">
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