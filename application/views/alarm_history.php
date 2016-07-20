<?php require_once('name_parse.php'); ?>

<html>
<head>
    <link rel="stylesheet" href="/static/css/production.css">
    <link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <!--表单区域-->
    <div class="container" id="part">
    <h2>故障列表</h2>
    <form action="/index.php/Alarm/showAllAlarm" method="post" class="form-inline">
        <div class="form-group">
            <label for="equipmentNumber">设备编号</label>
            <select name="equipmentNumber" id="equipmentNumber" class="form-control">
                <option value="11"><?=$equipment['11'] ?></option>
                <option value="12"><?=$equipment['12'] ?></option>
                <option value="13"><?=$equipment['13'] ?></option>
                <option value="14"><?=$equipment['14'] ?></option>
                <option value="15"><?=$equipment['15'] ?></option>
                <option value="16"><?=$equipment['16'] ?></option>
                <option value="21"><?=$equipment['21'] ?></option>
                <option value="22"><?=$equipment['22'] ?></option>
                <option value="23"><?=$equipment['23'] ?></option>
                <option value="24"><?=$equipment['24'] ?></option>
                <option value="25"><?=$equipment['25'] ?></option>
                <option value="26"><?=$equipment['26'] ?></option>
            </select>
        </div>
        <div class="form-group">
            <label for="timeStart">起始时间</label>
            <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd hh:ii">
                <input class="form-control" id="timeStart" name="timeStart" size="16" type="text" value="" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="form-group">
            <label for="timeEnd">结束时间</label>
            <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd hh:ii">
                <input class="form-control" id="timeEnd" name="timeEnd" size="16" type="text" value="" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">搜索</button>
        </div>
    </form>
</div>

    <!--表格区域-->
    <div class="container" <?php if(empty($alarm)) echo 'style="display: none"'; ?>  >
        <table class="table  table-hover table-bordered">
            <caption style="text-align: center"><h2>故障列表</h2></caption>
            <tr>
                <th>设备名称</th>
                <th>报警编号</th>
                <th>报警描述</th>
                <th>报警时间</th>
                <th>修复时间</th>
                <th>持续时间/s</th>
            </tr>
            <?php
            foreach($alarm as $row)
            {
                echo '<tr>';
                echo '<td>'.$equipment[$row['1']].'</td>';
                echo '<td>'.$row['2'].'</td>';
                echo '<td>'.$row['6'].'</td>';
                echo '<td>'.$row['3'].'</td>';
                echo '<td>'.$row['4'].'</td>';
                echo '<td>'.$row['5'].'</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>

    <!--日期控件-->
    <script type="text/javascript" src="/static/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/static/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $('.form_date').datetimepicker({
            language: 'zh-CN',
            weekStart: 0,
            todayBtn: 1,
            autoclose: 0,
            todayHighlight: 1,
            startView: 2,
            minView: 0,
            forceParse: 0
        });
    </script>
</body>
</html>