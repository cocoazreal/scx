<?php require_once('name_parse.php') ?>
<html>
<head>
    <link rel="stylesheet" href="/static/css/multilayer.css">
    <link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<!--表单-->
<div class="container" id="multilayer-form">
<h2 style="text-align: center;">加热炉历史状态</h2>
<form action="/index.php/MultilayerFurnaces/getHistoryData" method="post" class="form-inline">
    <div class="form-group">
        <label for="account">加热炉(膛)编号</label>
        <select class="form-control" id="account" name="account" placeholder="选择查询设备" required>
            <option value="A">加热炉A</option>
            <?php
            for ($i=11; $i < $this->config->item('furnacesNumber') + 11; $i++)
            {
                echo "<option value='$i'>".$furnaceName["$i"]."</option>";
            }
            ?>
            <option value="B">加热炉B</option>
            <?php
            for ($i=21; $i < $this->config->item('furnacesNumber') + 21; $i++)
            {
                echo "<option value='$i'>".$furnaceName["$i"]."</option>";
            }
            ?>
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
        <button class="btn btn-primary" type="submit">提交</button>
    </div>
</form>
</div>
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

<!--对数据处理-->
<?php
    if(isset($waterTemperature))
    {
        echo
        '<!--图表-->
        <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
        <div class="container"><div id="main"></div></div>';

        $waterTemperature = json_encode($waterTemperature);
        $waterPressure = json_encode($waterPressure);
        $gasTemperature = json_encode($gasTemperature);
        $gasPressure = json_encode($gasPressure);
        $gasDewPoint = json_encode($gasDewPoint);
        $gasPurity = json_encode($gasPurity);
        $timestamp = json_encode($timestamp);
    }
    else if (isset($currentTemperature))
    {
        echo
        '<!--图表-->
        <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
        <div class="container"><div id="main2"></div></div>';

        $currentTemperature = json_encode($currentTemperature);
        $timestamp = json_encode($timestamp);
    }
    else
    {
        if (isset($A))
        {
            echo
            '<!--图表-->
            <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
            <div class="container">
                <div id="main3"></div>
            </div>';
        }
        else
        {
            echo '<div class="container"><p>加热炉A今日无状态数据。</p></div>';
        }
        if (isset($B))
        {
            echo
            '<!--图表-->
            <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
            <div class="container">
                <div id="main4"></div>
            </div>';
        }
        else
        {
            echo '<div class="container"><p>加热炉B今日无状态数据。</p></div>';
        }
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
            'echarts/chart/line' // 加载模块，按需加载
        ],
        function (ec) {
            <?php
                if (isset($waterTemperature))
                {
                    echo "
                    // 基于准备好的dom，初始化echarts图表
                    var myChart = ec.init(document.getElementById('main'));

                    var option = {
                        title : {
                            text: '加热炉',
                            subtext: '温度--时间'
                        },
                        tooltip : {
                            trigger: 'axis'
                        },
                        legend: {
                            data:['水温','气体温度','气体露点']
                        },
                        toolbox: {
                            show : true,
                            feature : {
                                dataView : {show: true, readOnly: false},
                                restore : {show: true},
                                saveAsImage : {show: true}
                            }
                        },
                        dataZoom : {
                            show : true,
                            realtime: true,
                            start : 0,
                            end : 100
                        },
                        xAxis : [
                            {
                                type : 'category',
                                boundaryGap : false,
                                data : {$timestamp},
                                axisLine : {
                                    onZero : false
                                }
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value',
                                axisLabel : {
                                    formatter: '{value} °C'
                                }
                            }
                        ],
                        series : [
                            {
                                name:'水温',
                                type:'line',
                                data:{$waterTemperature},
                                markPoint : {
                                    data : [
                                        {type : 'max', name: '最大值'},
                                        {type : 'min', name: '最小值'}
                                    ]
                                }
                            },
                            {
                                name:'气体温度',
                                type:'line',
                                data:{$gasTemperature},
                                markPoint : {
                                    data : [
                                        {type : 'max', name: '最大值'},
                                        {type : 'min', name: '最小值'}
                                    ]
                                }
                            },
                            {
                                name:'气体露点',
                                type:'line',
                                data:{$gasDewPoint},
                                markPoint : {
                                    data : [
                                        {type : 'max', name: '最大值'},
                                        {type : 'min', name: '最小值'}
                                    ]
                                }
                            }
                        ]
                    };
                    // 为echarts对象加载数据
                    myChart.setOption(option);";
                }
                else if (isset($currentTemperature))
                {
                    echo "
                    // 基于准备好的dom，初始化echarts图表
                    var myChart2 = ec.init(document.getElementById('main2'));

                    var option2 = {
                        title : {
                            text: '加热炉炉膛".$furnaceName[$data['account']]."',
                            subtext: '温度--时间'
                        },
                        tooltip : {
                            trigger: 'axis'
                        },
                        legend: {
                            data:['温度']
                        },
                        toolbox: {
                            show : true,
                            feature : {
                                dataView : {show: true, readOnly: false},
                                restore : {show: true},
                                saveAsImage : {show: true}
                            }
                        },
                        dataZoom : {
                            show : true,
                            realtime: true,
                            start : 0,
                            end : 100
                        },
                        xAxis : [
                            {
                                type : 'category',
                                boundaryGap : false,
                                data : {$timestamp},
                                axisLine : {
                                    onZero : false
                                }
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value',
                                axisLabel : {
                                    formatter: '{value} °C'
                                }
                            }
                        ],
                        series : [
                            {
                                name:'温度',
                                type:'line',
                                data:{$currentTemperature},
                                markPoint : {
                                    data : [
                                        {type : 'max', name: '最大值'},
                                        {type : 'min', name: '最小值'}
                                    ]
                                }
                            }
                        ]
                    };


                    // 为echarts对象加载数据
                    myChart2.setOption(option2);";
                }
                else
                {
                    if (isset($A))
                    {
                        echo "
                        // 基于准备好的dom，初始化echarts图表
                        var myChart = ec.init(document.getElementById('main3'));

                        var option = {
                            title : {
                                text: '加热炉A今日状态',
                                subtext: '温度--时间'
                            },
                            tooltip : {
                                trigger: 'axis'
                            },
                            legend: {
                                data:['水温','气体温度','气体露点']
                            },
                            toolbox: {
                                show : true,
                                feature : {
                                    dataView : {show: true, readOnly: false},
                                    restore : {show: true},
                                    saveAsImage : {show: true}
                                }
                            },
                            dataZoom : {
                                show : true,
                                realtime: true,
                                start : 0,
                                end : 100
                            },
                            xAxis : [
                                {
                                    type : 'category',
                                    boundaryGap : false,
                                    data : ".json_encode($A['timestamp']).",
                                    axisLine : {
                                        onZero : false
                                    }
                                }
                            ],
                            yAxis : [
                                {
                                    type : 'value',
                                    axisLabel : {
                                        formatter: '{value} °C'
                                    }
                                }
                            ],
                            series : [
                                {
                                    name:'水温',
                                    type:'line',
                                    data:".json_encode($A['waterTemperature']).",
                                    markPoint : {
                                        data : [
                                            {type : 'max', name: '最大值'},
                                            {type : 'min', name: '最小值'}
                                        ]
                                    }
                                },
                                {
                                    name:'气体温度',
                                    type:'line',
                                    data:".json_encode($A['gasTemperature']).",
                                    markPoint : {
                                        data : [
                                            {type : 'max', name: '最大值'},
                                            {type : 'min', name: '最小值'}
                                        ]
                                    }
                                },
                                {
                                    name:'气体露点',
                                    type:'line',
                                    data:".json_encode($A['gasDewPoint']).",
                                    markPoint : {
                                        data : [
                                            {type : 'max', name: '最大值'},
                                            {type : 'min', name: '最小值'}
                                        ]
                                    }
                                }
                            ]
                        };
                        // 为echarts对象加载数据
                        myChart.setOption(option);";
                    }
                    if (isset($B))
                    {
                        echo "
                        // 基于准备好的dom，初始化echarts图表
                        var myChart2 = ec.init(document.getElementById('main4'))

                        var option2 = {
                            title : {
                                text: '加热炉B今日状态',
                                subtext: '温度--时间'
                            },
                            tooltip : {
                                trigger: 'axis'
                            },
                            legend: {
                                data:['水温','气体温度','气体露点']
                            },
                            toolbox: {
                                show : true,
                                feature : {
                                    dataView : {show: true, readOnly: false},
                                    restore : {show: true},
                                    saveAsImage : {show: true}
                                }
                            },
                            dataZoom : {
                                show : true,
                                realtime: true,
                                start : 0,
                                end : 100
                            },
                            xAxis : [
                                {
                                    type : 'category',
                                    boundaryGap : false,
                                    data : ".json_encode($B['timestamp']).",
                                    axisLine : {
                                        onZero : false
                                    }
                                }
                            ],
                            yAxis : [
                                {
                                    type : 'value',
                                    axisLabel : {
                                        formatter: '{value} °C'
                                    }
                                }
                            ],
                            series : [
                                {
                                    name:'水温',
                                    type:'line',
                                    data:".json_encode($B['waterTemperature']).",
                                    markPoint : {
                                        data : [
                                            {type : 'max', name: '最大值'},
                                            {type : 'min', name: '最小值'}
                                        ]
                                    }
                                },
                                {
                                    name:'气体温度',
                                    type:'line',
                                    data:".json_encode($B['gasTemperature']).",
                                    markPoint : {
                                        data : [
                                            {type : 'max', name: '最大值'},
                                            {type : 'min', name: '最小值'}
                                        ]
                                    }
                                },
                                {
                                    name:'气体露点',
                                    type:'line',
                                    data:".json_encode($B['gasDewPoint']).",
                                    markPoint : {
                                        data : [
                                            {type : 'max', name: '最大值'},
                                            {type : 'min', name: '最小值'}
                                        ]
                                    }
                                }
                            ]
                        };
                        // 为echarts对象加载数据
                        myChart2.setOption(option2);";
                    }
                }
            ?>
        }
    );
</script>
</body>
</html>