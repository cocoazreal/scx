<?php require_once('name_parse.php') ?>
<html>
<head>
	<link rel="stylesheet" href="/static/css/production.css">
</head>
<body>
	<!--表格区域-->
    <div class="container" style="margin-top: 50px;" <?php if(!isset($part)) echo 'style="display: none"'; ?> >
        <table class="table table-hover table-bordered">
            <caption style="text-align: center"><h2>零件生产详细信息</h2></caption>
            <tr>
            	<th colspan="4">零件生产参数</th>
            </tr>
            <tr>
                <td width="260px">零件编号</td><td width="260px"><?= $part['partNumber'] ?></td>
                <td width="260px">产品编号</td><td><?= $part['productNumber'] ?></td>
            </tr>
            <tr>
                <td>加热温度/℃</td><td><?= $part['heatTemperature'] ?></td>
                <td>加热时长/s</td><td><?= $part['heatDuration'] ?></td>
            </tr>
            <tr>
            	<td>保压压力/吨</td><td><?= $part['holdingPressure'] ?></td>
            	<td>保压时长/s</td><td><?= $part['holdingDuration'] ?></td>
            </tr>
            <tr>
            	<td>成形温度/℃</td><td><?= $part['formingTemperature'] ?></td>
            	<td>出模温度/℃</td><td><?= $part['demouldingTemperature'] ?></td>
            </tr>
            <tr>
            	<td>冷却水入口温度/℃</td><td><?= $part['waterInletTemperature'] ?></td>
            	<td>冷却水出口温度/℃</td><td><?= $part['waterOutletTemperature'] ?></td>
            </tr>
            <tr>
            	<td>加热炉膛</td><td><?= $part['furnaceNumber'] ?></td>
            	<td>空气中暴露时长/s</td><td><?= $part['exposedDuration'] ?></td>
            </tr>
            <tr>
            	<td>是否废料</td><td><?= $part['isTrash'] ?></td>
            	<td>生产时间</td><td><?= $part['timestamp'] ?></td>
            </tr>
        </table>
        <table class="table table-hover table-bordered" style="<?php if(!isset($press)) {echo 'display: none';} ?>">
            <tr>
            	<th colspan="4">压力机运动参数</th>
            </tr>
            <tr>
            	<td width="260px">运行速度/百分比</td><td width="260px"><?= $press['velocity'] ?></td>
            	<td width="260px">运行节拍/s</td><td><?= $press['beat'] ?></td>
            </tr>
            <tr>
            	<td>保压开始时间</td><td><?= $press['startHoldingTime'] ?></td>
            	<td>保压结束时间</td><td><?= $press['endHoldingTime'] ?></td>
            </tr>
            <tr>
            	<td>运行开始时间</td><td><?= $press['startTime'] ?></td>
            	<td>运行结束时间</td><td><?= $press['endTime'] ?></td>
            </tr>
            <tr>
            	<td>保压时长/s</td><td><?= $press['totalHoldingTime'] ?></td>
            	<td>运行总时长/s</td><td><?= $press['totalTime'] ?></td>
            </tr>
        </table>
        <table class="table table-hover table-bordered" style="<?php if(!isset($robot)) {echo 'display: none';} ?>">
            <tr>
            	<th colspan="10"><?= $robot[0]['equipmentName'] ?>运动参数</th>
            </tr>
            <tr>
            	<td>运行开始时间</td><td><?= $robot[0]['startTime'] ?></td>
            	<td>运行结束时间</td><td><?= $robot[0]['endTime'] ?></td>
            	<td>运行总时长/s</td><td><?= $robot[0]['totalTime'] ?></td>
            	<td>运行速度/百分比</td><td><?= $robot[0]['velocity'] ?></td>
            	<td>目标位置</td><td><?php echo $robot[0]['targetPosition'] == '1' ? '垛A' : '垛B'; ?></td>
            </tr>

            <?php
            	if (isset($robot))
            	{
            		for ($i=1; $i < count($robot); $i++)
            		{
            			echo "<tr>
				            	<th colspan='10'>".$robot[$i]['equipmentName']."运动参数</th>
				              </tr>
				              <tr>
				            	<td>运行开始时间</td><td>".$robot[$i]['startTime']."</td>".
				            	"<td>运行结束时间</td><td>".$robot[$i]['endTime']."</td>".
				            	"<td>运行总时长/s</td><td>".$robot[$i]['totalTime']."</td>".
				            	"<td>运行速度/百分比</td><td>".$robot[$i]['velocity']."</td>".
				            	"<td>目标位置</td><td>".$furnaceName[$robot[$i]['targetPosition']]."</td>".
				     	      "</tr>";
            		}
            	}
            ?>
        </table>
    </div>
</body>
</html>