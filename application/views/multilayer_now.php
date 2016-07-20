<?php require_once 'name_parse.php' ?>
<html>
<head>
    <link rel="stylesheet" href="/static/css/multilayer.css">
</head>
<body>
    <div class="container" id="multilayer-now">
        <table class="table table-hover table-bordered">
            <caption><h2 style="text-align: center;">加热炉A/B 当前状态</h2></caption>
            <tr>
                <th>加热炉编号</th>
                <th>冷却水温度(℃)</th>
                <th>冷却水压强(MPa)</th>
                <th>保护气温度(℃)</th>
                <th>保护气压强(MPa)</th>
                <th>保护气露点(℃)</th>
                <th>保护气纯度(百分比)</th>
            </tr>
            <?php
                for($i = 0; $i < 2; $i++)
                {
                    echo '<tr>';
                    echo '<td>'.$equipment[$nowData[$i]['furnacesNumber']].'</td>';
                    echo '<td>'.$nowData[$i]['waterTemperature'] / 10 .'</td>';
                    echo '<td>'.$nowData[$i]['waterPressure'] / 10 .'</td>';
                    echo '<td>'.$nowData[$i]['gasTemperature'] / 10 .'</td>';
                    echo '<td>'.$nowData[$i]['gasPressure'] / 10 .'</td>';
                    echo '<td>'.$nowData[$i]['gasDewPoint'] / 10 .'</td>';
                    echo '<td>'.$nowData[$i]['gasPurity'] / 10 .'</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>

<!--对数据处理-->
<?php
    if(isset($nowData))
    {
        $currentTemperature = array();
        $setTemperature = array();
        $isHeating = array();
        for($i = 2; $i < $this->config->item('furnacesNumber') * 2 + 2; $i++)
        {
            array_push($currentTemperature, $nowData[$i]['currentTemperature'] / 10);
            array_push($setTemperature, $nowData[$i]['setTemperature'] / 10);
            array_push($isHeating, $nowData[$i]['isHeating']);
        }
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
                    text: '加热炉A/B每层炉膛的当前状态',
                    subtext : '绿色：正在加温；灰色：没有加热'
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['当前温度', '设定温度'],
                    selected : {
                        '设定温度' : false
                    }
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
                        data : <?=$this->config->item('allFurnacesName')?>
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        axisLabel : {
                            formatter: '{value} ℃'
                        }
                    }
                ],
                series : [
                    {
                        name:'当前温度',
                        type:'bar',
                        data:<?php
                                echo "[";
                                for ($i=0; $i < $this->config->item('furnacesNumber') * 2; $i++)
                                {
                                    if($isHeating[$i] === 'Y')
                                    {
                                        echo "{
                                            value : {$currentTemperature[$i]},
                                            itemStyle : {
                                                normal : {
                                                    color : 'green'
                                                }
                                            }
                                        },";
                                    }
                                    else
                                    {
                                        echo "{
                                            value : {$currentTemperature[$i]},
                                            itemStyle : {
                                                normal : {
                                                    color : '#aaa'
                                                }
                                            }
                                        },";
                                    }
                                }
                                echo "]";
                        ?>,
                        itemStyle: {
                            normal: {
                                color: 'green'
                            }
                        }
                    },
                    {
                        name:'设定温度',
                        type:'bar',
                        data:<?php echo json_encode($setTemperature); ?>
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