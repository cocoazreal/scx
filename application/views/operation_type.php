<div class="container" style="margin-top: 50px;">
    <table class="table table-hover table-bordered">
        <caption style="text-align: center"><h2>操作类型</h2></caption>
        <tr>
            <th>操作编号</th>
            <th>操作名称</th>
            <th>操作描述</th>
        </tr>
        <?php
        foreach($operation as $row)
        {
            echo '<tr>';
            echo '<td>'.$row['operationNumber'].'</td>';
            echo '<td>'.$row['operationName'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>