<html>
<head>
    <link rel="stylesheet" href="/static/css/multilayer.css">
    <link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <!--统计分析表单-->
    <div class="container" id="multilayer-stat">
        <h2 style="text-align: center;">加热炉统计</h2>
        <form action="/index.php/MultilayerFurnaces/getStatData" method="post" class="form-inline">
            <div class="form-group col-xs-4">
                <label for="view">查看方式</label>
                <select class="form-control" id="view" name="view" required>
                    <option value="default">一段时间内</option>
                    <option value="day">按天</option>
                </select>
            </div>
            <div class="form-group col-xs-4">
                <label for="timeStart">起始时间</label>
                <div class="input-group date form_date" data-date="">
                    <input class="form-control" id="timeStart" name="timeStart" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <div class="form-group col-xs-4">
                <label for="timeEnd">结束时间</label>
                <div class="input-group date form_date" data-date="">
                    <input class="form-control" id="timeEnd" name="timeEnd" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <div class="form-group col-xs-4">
                <label for="category">查看类别</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="heatingTime">升温总时长</option>
                    <option value="largerTime">大于某温度时长</option>
                    <option value="usageRates">炉膛使用率</option>
                    <option value="heatingCount">炉膛加热板料数</option>
                </select>
            </div>
            <div class="form-group col-xs-4">
                <label for="compareTemperature">大于温度值</label>
                <input type="text" class="form-control" name="compareTemperature" id="compareTemperature" value="100" placeholder="默认值100℃">
            </div>
            <div class="form-group col-xs-4">
                <button class="btn btn-primary" type="submit">统计分析</button>
            </div>
        </form>
    </div>

<script type="text/javascript" src="/static/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="/static/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
$('.form_date').datetimepicker({
    format: 'yyyy-mm-dd',
    language: 'zh-CN',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 0,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
</script>

<!--对数据处理-->
<?php
    if(isset($furnaces))
    {
        echo
        '<!--图表-->
        <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
        <div class="container"><div id="main"></div></div>';
    }
?>

<!-- ECharts单文件引入 -->
<script src="/static/js/dist/echarts.js"></script>
<script type="text/javascript">
    // 路径配置
    require.config({
        paths: {
            echarts: '/static/js/dist'
        }
    });

    // 使用
    require(
        [
            'echarts',
            'echarts/chart/line', // 加载模块，按需加载
            'echarts/chart/bar' // 加载模块，按需加载
        ],
        function (ec) {
            // 基于准备好的dom，初始化echarts图表
            var myChart = ec.init(document.getElementById('main'));

            var option = {
                title : {
                    text: '炉膛使用统计'
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:<?php
                         echo "[";
                         for ($i=1; $i <= $this->config->item('furnacesNumber'); $i++)
                         {
                             echo "'炉A{$i}',";
                         }
                         echo "'',";
                         for ($i=1; $i <= $this->config->item('furnacesNumber'); $i++)
                         {
                             echo "'炉B{$i}',";
                         }
                         echo "]";
                         ?>
                },
                toolbox: {
                    show : true,
                    feature : {
                        dataView : {show: true, readOnly: false},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                xAxis : [
                    {
                        type : 'category',
                        data : <?php echo json_encode($time); ?>
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        axisLabel : {
                            formatter: '{value} '
                        }
                    }
                ],
                series : [
                    <?php
                    for ($i=1; $i <= $this->config->item('furnacesNumber'); $i++)
                    {
                        echo "{
                                name:'炉A{$i}',
                                type:'bar',
                                data:".json_encode($furnaces[10 + $i])."
                              },";
                    }
                    ?>
                    <?php
                    for ($i=1; $i <= $this->config->item('furnacesNumber'); $i++)
                    {
                        echo "{
                                name:'炉B{$i}',
                                type:'bar',
                                data:".json_encode($furnaces[20 + $i])."
                              },";
                    }
                    ?>
                ]
            };


            // 为echarts对象加载数据
            myChart.setOption(option);

        }
    );
</script>

</body>
</html>