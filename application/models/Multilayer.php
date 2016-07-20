<?php
/**
 * Created by PhpStorm.
 * User: Kuan.C
 * Date: 2015/8/29
 * Time: 15:13
 */

class Multilayer extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 根据加热炉编号 和 时间 获得加热炉水温
     *
     * @param Array data 提交的表单
     * @return Array result 返回水温数组
     */
    public function getAll($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        //编号
        $account = $data['account'];

        //转换编号
        if($account == 'A')
        {
            $furnacesNumber = 14;
            //sql
            $sql = "select * from multilayer_furnaces where furnacesNumber = '$furnacesNumber' AND (timestamp BETWEEN '$timeStart' AND '$timeEnd') ORDER BY timestamp ASC";
        }
        else if ($account == 'B')
        {
            $furnacesNumber = 15;
            //sql
            $sql = "select * from multilayer_furnaces where furnacesNumber = '$furnacesNumber' AND (timestamp BETWEEN '$timeStart' AND '$timeEnd') ORDER BY timestamp ASC";
        }
        else
        {
            $sql = "select * from furnace where furnaceNumber = '$account' AND (timestamp BETWEEN '$timeStart' AND '$timeEnd') ORDER BY timestamp ASC";
        }

        // 查询
        $query = $this->db->query($sql);
        // 如果未查询到结果，返回null。
        if (!($query->num_rows() > 0))
        {
            return null;
        }

        // 查询到结果，继续处理
        $result = $query->result_array();

        if ($account == 'A' || $account == 'B')
        {
            return $this->parseData($result);
        }
        else
        {
            $rs_currentTemperature = array();
            $rs_timestamp = array();

            foreach ($result as $row)
            {
                array_push($rs_currentTemperature, $row['currentTemperature'] / 10);
                array_push($rs_timestamp, $row['timestamp']);
            }

            $rs = array(
                'currentTemperature' => $rs_currentTemperature,
                'timestamp' => $rs_timestamp,
                'data' => $data,
                );
            return $rs;
        }
    }

    /**
     * [getTodayHistoryData description]
     * @return [type] [description]
     */
    public function getTodayHistoryData()
    {
        $timeStart = date("Y-m-d");
        $timeEnd = date("Y-m-d", strtotime("+1 day"));
        $furnacesNumber = 14;
        $sql = "select * from multilayer_furnaces where furnacesNumber = '$furnacesNumber' AND (timestamp BETWEEN '$timeStart' AND '$timeEnd') ORDER BY timestamp ASC";
        $furnaces = array();
        //查询
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result[0] = $query->result_array();
            $furnaces['A'] = $this->parseData($result[0]);
        }

        $furnacesNumber = 15;

        //查询
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result[1] = $query->result_array();
            $furnaces['B'] = $this->parseData($result[1]);
        }

        return $furnaces;
    }



    private function parseData($result)
    {
        // 创建不同类别的数组用于存储数据
        $rs_waterTemperature = array();
        $rs_waterPressure = array();
        $rs_gasTemperature = array();
        $rs_gasPressure = array();
        $rs_gasDewPoint = array();
        $rs_gasPurity = array();
        $rs_timestamp = array();

        foreach($result as $row)
        {
            array_push($rs_waterTemperature,$row['waterTemperature'] / 10);
            array_push($rs_waterPressure,$row['waterPressure'] / 10);
            array_push($rs_gasTemperature,$row['gasTemperature'] / 10);
            array_push($rs_gasPressure,$row['gasPressure'] / 10);
            array_push($rs_gasDewPoint,$row['gasDewPoint'] / 10);
            array_push($rs_gasPurity,$row['gasPurity'] / 10);
            array_push($rs_timestamp,$row['timestamp']);
        }

        $rs = array(
            'waterTemperature' => $rs_waterTemperature,
            'waterPressure' => $rs_waterPressure,
            'gasTemperature' => $rs_gasTemperature,
            'gasPressure' => $rs_gasPressure,
            'gasDewPoint' => $rs_gasDewPoint,
            'gasPurity' => $rs_gasPurity,
            'timestamp' => $rs_timestamp
            );
        return $rs;
    }
    /**
     * 获得所有加热炉的状态
     *
     * @return Array $result 所有加热炉的信息
     */
    public function getAllNow()
    {
        // 用于存放所有加热炉的最新数据
        $result = array();
        $query = $this->db->order_by('timestamp','DESC')->get_where('multilayer_furnaces',array('furnacesNumber' => 14));
        $result_A = $query->row_array();
        array_push($result, $result_A);
        $query = $this->db->order_by('timestamp','DESC')->get_where('multilayer_furnaces',array('furnacesNumber' => 15));
        $result_B = $query->row_array();
        array_push($result, $result_B);
        for($i = 11; $i < 11 + $this->config->item('furnacesNumber'); $i++)
        {
            $query = $this->db->order_by('timestamp','DESC')->get_where('furnace',array('furnaceNumber' => $i));
            array_push($result, $query->row_array());
        }
        for($i = 21; $i < 21 + $this->config->item('furnacesNumber'); $i++)
        {
            $query = $this->db->order_by('timestamp','DESC')->get_where('furnace',array('furnaceNumber' => $i));
            array_push($result, $query->row_array());
        }
        return $result;
    }

    /**
     * 根据温度显示各个炉膛的时间
     *
     * @param int $data 温度
     * @return Array $result 时间数组
     */
    public function getTimeByTemp($data)
    {
        // 用于存放时间
        $result = array();

        for($i = 11; $i < 11 + $this->config->item('furnacesNumber'); $i++)
        {
            $this->db->where('currentTemperature >', $data['temperature'] * 10);
            $this->db->where('furnaceNumber', $i);
            $query = $this->db->get('furnace');
            $num = count($query->result_array());
            array_push($result, $num);
        }
        for($i = 21; $i < 21 + $this->config->item('furnacesNumber'); $i++)
        {
            $this->db->where('currentTemperature >', $data['temperature'] * 10);
            $this->db->where('furnaceNumber', $i);
            $query = $this->db->get('furnace');
            $num = count($query->result_array());
            array_push($result, $num);
        }
        return $result;
    }

    /**
     * 查看加热炉炉膛在一段时间内的升温时长
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getHeatingTime($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        $sql = "SELECT furnaceNumber, count(*) as count
        FROM furnace WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND isHeating = 'Y' group by furnaceNumber;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 按天查看加热炉炉膛的升温时长
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getHeatingTimeByDay($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        $sql = "SELECT furnaceNumber, date_format(`timestamp`,'%Y-%m-%d') AS time, count(*) as count
        FROM furnace WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND isHeating = 'Y' group by time, furnaceNumber;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 查看加热炉炉膛温度在一段时间内大于某个温度的时长
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getLargerTime($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        $temp = $data['compareTemperature'] * 10;
        $sql = "SELECT furnaceNumber, count(*) as count
        FROM furnace WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND currentTemperature > '$temp' group by furnaceNumber;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 按天查看加热炉炉膛温度大于某个温度的时长
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getLargerTimeByDay($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        $temp = $data['compareTemperature'] * 10;
        $sql = "SELECT furnaceNumber, date_format(`timestamp`,'%Y-%m-%d') AS time, count(*) as count
        FROM furnace WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND currentTemperature > '$temp' group by time, furnaceNumber;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 查看加热炉炉膛在一段时间内有板料的使用率
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getUsageRates($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        $temp = $data['compareTemperature'];
        $sql_finishedHeating = "SELECT furnaceNumber, count(*) as count
        FROM furnace WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND finishedHeating = 'Y' group by furnaceNumber;";
        $sql_hasSheet = "SELECT furnaceNumber, count(*) as count
        FROM furnace WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND hasSheet = 'Y' group by furnaceNumber;";
        $query1 = $this->db->query($sql_finishedHeating);
        $query2 = $this->db->query($sql_hasSheet);
        if ($query1->num_rows() > 0) {
            $result1 = $query1->result_array();
        }
        if ($query2->num_rows() > 0) {
            $result2 = $query2->result_array();
        }
        $result3 = array();
        if (count($result1) > 0)
        {
            for ($i=0,$j=0; $i < count($result1); $i++)
            {
                if ($result1[$i]['furnaceNumber'] === $result2[$j]['furnaceNumber'])
                {
                    $result3[$i]['count'] = number_format($result2[$j]['count'] / (float)$result1[$i]['count'], 2);
                    $j++;
                }
                else
                {
                    $result3[$i]['count'] = 0;
                }
                $result3[$i]['furnaceNumber'] = $result1[$i]['furnaceNumber'];
            }
        }
        return $result3;
    }

    /**
     * 按天查看加热炉炉膛有板料的使用率
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getUsageRatesByDay($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        $temp = $data['compareTemperature'];
        $sql_finishedHeating = "SELECT furnaceNumber, date_format(`timestamp`,'%Y-%m-%d') AS time, count(*) as count
        FROM furnace WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND finishedHeating = 'Y' group by time, furnaceNumber;";
        $sql_hasSheet = "SELECT furnaceNumber, date_format(`timestamp`,'%Y-%m-%d') AS time, count(*) as count
        FROM furnace WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND hasSheet = 'Y' group by time, furnaceNumber;";
        $query1 = $this->db->query($sql_finishedHeating);
        $query2 = $this->db->query($sql_hasSheet);
        if ($query1->num_rows() > 0) {
            $result1 = $query1->result_array();
        }
        if ($query2->num_rows() > 0) {
            $result2 = $query2->result_array();
        }
        $result3 = array();
        if (count($result1) > 0)
        {
            for ($i=0,$j=0; $i < count($result1); $i++)
            {
                if ($result1[$i]['time'] === $result2[$j]['time']
                    && $result1[$i]['furnaceNumber'] === $result2[$j]['furnaceNumber'])
                {
                    $result3[$i]['count'] = $result2[$j]['count'] / (float)$result1[$i]['count'];
                    $j++;
                }
                else
                {
                    $result3[$i]['count'] = 0;
                }
                $result3[$i]['furnaceNumber'] = $result1[$i]['furnaceNumber'];
                $result3[$i]['time'] = $result1[$i]['time'];
            }
        }
        return $result3;
    }

    /**
     * 查看加热炉炉膛在一段时间内加热板料的数量
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getHeatingCount($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        $sql = "SELECT furnaceNumber, count(*) as count
        FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' group by furnaceNumber;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 按天查看加热炉炉膛加热板料的数量
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getHeatingCountByDay($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        $sql = "SELECT furnaceNumber, date_format(`timestamp`,'%Y-%m-%d') AS time, count(*) as count
        FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' group by time, furnaceNumber;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}