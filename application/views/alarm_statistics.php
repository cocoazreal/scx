<?php require_once('name_parse.php'); ?>

<html>
<head>
    <link rel="stylesheet" href="/static/css/production.css">
    <link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <!--表单区域-->
    <div class="container" id="part">
        <h2>故障统计</h2>
        <form action="" method="post" class="form-inline">
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

    <!--图标区域-->

    <?php
    //数据处理
    if(isset($alarm))
    {
        $count = json_encode($alarm['count']);
        $time = json_encode($alarm['time']);
        $name = json_encode($alarm['name']);
        $number = json_encode($alarm['number']);

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
                'echarts/chart/bar' // 使用柱状图就加载bar模块，按需加载
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('main'));

                var option = {
                        title: {
                            text: '故障类型--出现次数',
                            subtext: ''
                        },
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data: ['数量']
                        },
                        toolbox: {
                            show: true,
                            orient: 'vertical',
                            x: 'right',
                            y: 'center',
                            feature: {
                                dataView: {show: true, readOnly: false},
                                restore: {show: true},
                                saveAsImage: {show: true}
                            }
                        },
                        calculable: true,
                        xAxis: [
                            {
                                type: 'category',
                                data: <?=$name; ?>
                            }
                        ],
                        yAxis: [
                            {
                                type: 'value'
                            }
                        ],
                        series: [
                            {
                                name: '发生次数',
                                type: 'bar',
                                data:<?=$count; ?>,
                            }
                        ]
                };

                // 为echarts对象加载数据
                myChart.setOption(option);
            }
        );
    </script>

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