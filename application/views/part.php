<html>
<head>
    <link rel="stylesheet" href="/static/css/production.css">
    <link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <!--表单区域-->
    <div class="container" id="part">
        <h2>零件列表</h2>
        <form action="/index.php/production/getAllPart" method="post" class="form-inline">
            <div class="form-group">
                <label for="id">零件编号</label>
                <input type="text" class="form-control" id="id" name="id">
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
    <div class="container" <?php if(!isset($part)) echo 'style="display: none"'; ?> >
        <table class="table table-hover table-bordered">
            <caption style="text-align: center"><h2>零件列表</h2></caption>
            <tr>
                <th width="125px">零件编号</th>
                <th width="100px">产品编号</th>
                <th width="100px">加热温度/℃</th>
                <th width="100px">加热时长/s</th>
                <th width="100px">炉膛编号</th>
                <th width="140px">空气中暴露时长/s</th>
                <th width="100px">合模温度/℃</th>
                <th width="100px">出模温度/℃</th>
                <th>生产时间</th>
            </tr>
            <?php
                foreach($part as $row)
                {
                    echo '<tr>';
                    echo '<td><a href="/index.php/production/getPartInfo/'.$row['partNumber'].'">'.$row['partNumber'].'</a></td>';
                    echo '<td>'.$row['productNumber'].'</td>';
                    echo '<td>'.$row['heatTemperature'] / 10 .'</td>';
                    echo '<td>'.$row['heatDuration'] / 10 .'</td>';
                    echo '<td>'.$row['furnaceNumber'].'</td>';
                    echo '<td>'.$row['exposedDuration'] / 10 .'</td>';
                    echo '<td>'.$row['formingTemperature'] / 10 .'</td>';
                    echo '<td>'.$row['demouldingTemperature'] / 10 .'</td>';
                    echo '<td>'.$row['timestamp'].'</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>

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

    <script type="text/javascript" src="/static/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/static/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript">
    $('.form_date').datetimepicker({
      language: 'zh-CN',
      weekStart: 1,
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