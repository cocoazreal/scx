<html>
<head>
    <link rel="stylesheet" href="/static/css/index.css">
</head>
<body>
    <div class="container" id="output_statistic"><h1>产量统计</h1></div>
<!--数据处理-->
<?php
    $product_today = null;
    $str_today = null;
    $product_yesterday = null;
    $str_yesterday = null;
    $product_week = null;
    $str_week =null;

    $total_today = 0;
    if(is_array($today))
    {
        $total_today = handleData($product_today, $str_today, $today);
    }

    $total_yesterday = 0;
    if(is_array($yesterday))
    {
        $total_yesterday = handleData($product_yesterday, $str_yesterday, $yesterday);
    }

    $total_week = 0;
    if(is_array($week))
    {
        $total_week = handleData($product_week, $str_week, $week);
    }

    // 输出生产图表所需的JavaScript语句
    function defineChart($id, $name, $product, $str)
    {
        if ($product) {
            $product = json_encode($product);
        }
        else {
            $product = "[]";
        }

        if ($str) {
            $str = "[".$str."]";
        } else {
            $str ="[]";
        }

        echo "
            var myChart"."$id = ec.init(document.getElementById('mainContent"."$id'));

                var option"."$id = {
                    title: {
                        text: '"."$name',
                        x: 'center'
                    },
                    tooltip : {
                        trigger: 'item',
                        formatter: '{a} <br/>{b} : {c} ({d}%)'
                    },
                    legend: {
                        orient : 'vertical',
                        x : 'left',
                        data: $product
                    },
                    toolbox: {
                        show : true,
                        feature : {
                            dataView : {show: true, readOnly: false},
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                    },
                    calculable : true,
                    series : [
                        {
                            name:'"."$name',
                            type:'pie',
                            radius : ['50%', '70%'],
                            itemStyle : {
                                normal : {
                                    label : {
                                        show : false
                                    },
                                    labelLine : {
                                        show : false
                                    }
                                },
                                emphasis : {
                                    label : {
                                        show : true,
                                        position : 'center',
                                        textStyle : {
                                            fontSize : '30',
                                            fontWeight : 'bold'
                                        }
                                    }
                                }
                            },
                            data:$str
                        }
                    ]
                };
                // 为echarts对象加载数据
                myChart"."$id.setOption(option"."$id);
            ";
    }

    // 处理数据库返回的数据，方便在页面显示
    function handleData(&$product, &$str, $data)
    {
        $total = 0;
        $product = array();
        $str = "";
        foreach ($data as $key => $value)
        {
            array_push($product, $value['productNumber']);
            $str .= "{value:".$value['count'].", name:'".$value['productNumber']."'},";
            $total += $value['count'];
        }
        $str = substr($str, 0, strlen($str) - 1);
        return $total;
    }
?>
<!-- 数据处理完成 -->

<div class='container'><p class='lead '>今日产量总数：<?=$total_today?> 件。昨日产量总数：<?=$total_yesterday?> 件。本周产量总数：<?=$total_week?> 件。</p></div>
<!--图表-->
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div class="container">
    <!-- 今日产量图表 -->
    <div id="mainContent1"></div>
    <!-- 昨日产量图表 -->
    <div id="mainContent2"></div>
    <!-- 本周产量图表 -->
    <div id="mainContent3"></div>
</div>

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
            'echarts/chart/bar',  // 加载模块，按需加载
            'echarts/chart/pie'   // 加载模块，按需加载
        ],
        function (ec) {
            <?php
            defineChart("1", "今日产量", $product_today, $str_today);
            defineChart("2", "昨日产量", $product_yesterday, $str_yesterday);
            defineChart("3", "本周产量", $product_week, $str_week);
            ?>
        }
    );
</script>
</body>
</html>