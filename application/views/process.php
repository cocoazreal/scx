<?php require_once('name_parse.php') ?>
<html>
<head>
    <script src="/static/js/fix.js"></script>
</head>
<body>
    <div class="container-fluid" style="margin-top: 50px;">
    <table class="table table-hover table-bordered" id="process_list">
        <caption style="text-align: center"><h2>工艺列表</h2></caption>
        <tr>
            <th>工艺编号</th>
            <th>加热温度/℃</th>
            <th>加热时长/s</th>
            <th>成型温度、出模温度/℃</th>
            <th>冷却水入口温度、出口温度/℃</th>
            <th>冷却水流量(L/min)</th>
            <th>保压压力/吨</th>
            <th>保压时长/s</th>
            <th>成型速率/(mm/s)</th>
            <th>是否通保护气</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($process as $row)
        {
            echo '<tr>';
            echo '<td rowspan="2">'.$row['processNumber'].'</td>';
            echo '<td rowspan="2">'.$row['heatTemperature'] / 10 .'</td>';
            echo '<td rowspan="2">'.$row['heatDuration'] / 10 .'</td>';
            echo '<td>'.$row['formingTemperature'] / 10 .'</td>';
            echo '<td>'.$row['waterInletTemperature'] / 10 .'</td>';
            echo '<td rowspan="2">'.$row['waterFlow'] / 10 .'</td>';
            echo '<td rowspan="2">'.$row['holdingPresssure'] / 10 .'</td>';
            echo '<td rowspan="2">'.$row['holdingDuration'] / 10 .'</td>';
            echo '<td rowspan="2">'.$row['formingRate'] / 10 .'</td>';
            echo '<td rowspan="2">'.$true_false[$row['hasShieldGas']].'</td>';
            echo '<td rowspan="2">'.'<a data-toggle="modal" data-target="#fix" href="#" onclick="fixProcess(this)">修改</a>'.'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>'.$row['demouldingTemperature'] / 10 .'</td>';
            echo '<td>'.$row['waterOutletTemperature'] / 10 .'</td>';
            echo '</tr>';
        }
        ?>
    </table>


    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#fix" onclick="resetProcessModal(this)">
        添加新工艺
    </button>

    <!--分页-->
    <?php echo $this->pagination->create_links(); ?>

    <!--模态框-->
    <div class="modal fade" id="fix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">工艺信息修改</h4>
                </div>
                <div class="modal-body">
                    <form action="/index.php/production/fixProcess" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="processNumber" class="col-sm-3 control-label">工艺编号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="processNumber" name="processNumber" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="heatTemperature" class="col-sm-3 control-label">加热温度</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="heatTemperature" name="heatTemperature" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="heatDuration" class="col-sm-3 control-label">加热时长</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="heatDuration" name="heatDuration" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formingTemperature" class="col-sm-3 control-label">成型温度</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="formingTemperature" name="formingTemperature" required>
                            </div>
                        </div><div class="form-group">
                            <label for="demouldingTemperature" class="col-sm-3 control-label">出模温度</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="demouldingTemperature" name="demouldingTemperature" required>
                            </div>
                        </div><div class="form-group">
                            <label for="waterInletTemperature" class="col-sm-3 control-label">冷却水入口温度</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="waterInletTemperature" name="waterInletTemperature" required>
                            </div>
                        </div><div class="form-group">
                            <label for="waterOutletTemperature" class="col-sm-3 control-label">冷却水出口温度</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="waterOutletTemperature" name="waterOutletTemperature" required>
                            </div>
                        </div><div class="form-group">
                            <label for="waterFlow" class="col-sm-3 control-label">冷却水流量</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="waterFlow" name="waterFlow" required>
                            </div>
                        </div><div class="form-group">
                            <label for="holdingPresssure" class="col-sm-3 control-label">保压压力</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="holdingPresssure" name="holdingPresssure" required>
                            </div>
                        </div><div class="form-group">
                            <label for="holdingDuration" class="col-sm-3 control-label">保压时长</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="holdingDuration" name="holdingDuration" required>
                            </div>
                        </div><div class="form-group">
                            <label for="formingRate" class="col-sm-3 control-label">成型速率</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="formingRate" name="formingRate" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hasShieldGas" class="col-sm-3 control-label">是否通保护气</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="hasShieldGas" name="hasShieldGas">
                                    <option value="Y">可用</option>
                                    <option value="N">不可用</option>
                                  </select>
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