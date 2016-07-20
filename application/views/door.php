<div class="container" style="margin-top: 50px;">
    <table class="table table-hover table-bordered">
        <caption style="text-align: center"><h2>安全门记录</h2></caption>
        <tr>
            <th>安全门编号</th>
            <th>开门请求时间</th>
            <th>开门时间</th>
            <th>关门时间</th>
            <th>开门延迟时长</th>
            <th>开门总时长</th>
        </tr>
        <?php
        foreach($door as $row)
        {
            echo '<tr>';
            echo '<td>'.$row['doorNumber'].'</td>';
            echo '<td>'.$row['requestTime'].'</td>';
            echo '<td>'.$row['openTime'].'</td>';
            echo '<td>'.$row['closeTime'].'</td>';
            echo '<td>'.$row['openDelayTime'].'</td>';
            echo '<td>'.$row['openTotalTime'].'</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>