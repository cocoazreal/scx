<?php require_once('name_parse.php') ?>
<html>
<head>
    <link rel="stylesheet" href="/static/css/production.css">
    <link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <!--统计分析表单-->
    <div class="container" id="production-stat">
        <h2>生产统计</h2>
        <form action="/index.php/production/getStatData" method="post" class="form-inline">
            <div class="form-group">
                <label for="view">查看方式</label>
                <select class="form-control" id="view" name="view" required>
                    <option value="day">按天</option>
                    <option value="week">按周</option>
                    <option value="month">按月</option>
                    <option value="year">按年</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">产品编号</label>
                <input type="text" class="form-control" id="productNumber" name="productNumber" style='width:120px'>
            </div>
            <div class="form-group">
                <label for="timeStart">起始时间</label>
                <div class="input-group date form_date" data-date="">
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
                <button class="btn btn-primary" type="submit">搜索</button>
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
    if(isset($time))
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
                    text: '生产统计',
                    subtext: <?php if(isset($view)){echo "'{$view_method[$view]}"."查看'";} ?>
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['产量']
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
                            formatter: '{value} 件'
                        }
                    }
                ],
                series : [
                    {
                        name:'产量',
                        type:'bar',
                        data:<?php echo json_encode($count); ?>,
                        itemStyle: {
                            normal: {
                                color: 'green'
                            }
                        }
                    }
                ]
            };


            // 为echarts对象加载数据
            myChart.setOption(option);

        }
    );
</script>

</body>
</html>