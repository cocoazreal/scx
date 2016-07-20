<?php require_once("name_parse.php"); ?>
<div class="container" style="margin-top: 50px;">
    <table class="table table-hover table-bordered">
        <caption style="text-align: center;"><h2>故障类型</h2></caption>
        <tr>
            <th>故障编号</th>
            <th>详细描述</th>
            <th>所处设备</th>
            <th>处理办法</th>
            <th>备注</th>
        </tr>
        <?php
        foreach($type as $row)
        {
            echo '<tr>';
            echo '<td>'.$row['alarmNumber'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            echo '<td>'.$equipment[$row['equipmentNumber']].'</td>';
            echo '<td>'.$row['removeMethod'].'</td>';
            echo '<td>'.$row['remark'].'</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>