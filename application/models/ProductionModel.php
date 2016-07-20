<?php

class ProductionModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 根据时间获得零件列表
     *
     * getPartByTime
     * @param Array $data 包含时间信息的数组
     * @return Array $result 包含零件信息的数组
     */
    public function getPartByTime($data)
    {
        $this->db->where('timestamp >=', $data['timeStart']);
        $this->db->where('timestamp <=', $data['timeEnd']);
        $query = $this->db->get('part');
        $result = $query->result_array();
        return $result;
    }

    /**
     * 根据零件编号获得零件信息
     *
     * getPartById
     * @param Array $data 包含零件id的数组
     * @reutrn Array $result 包含零件信息的数组
     */
    public function getPartById($data)
    {
        $this->db->where('partNumber', $data['id']);
        $query = $this->db->get('part');
        $result = $query->result_array();
        return $result;
    }

    public function getPartInfoByID($partNumber)
    {
        // 查询零件相关的机械手运动
        $sql = "SELECT robot.*, equipment.equipmentName FROM part, robot, equipment
        WHERE part.partNumber = robot.partNumber AND equipment.equipmentNumber = robot.robotNumber AND part.partNumber = ".$this->db->escape($partNumber);
        // 查询零件相关的压力机运动
        $sql2 = "SELECT press.* FROM part, press WHERE part.partNumber = press.partNumber AND part.partNumber = ".$this->db->escape($partNumber);

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {
            $robot = $query->result_array();
        }

        $query = $this->db->query($sql2);
        if ($query->num_rows() > 0)
        {
            $press = $query->row_array();
        }

        $part = $this->db->where('partNumber', $partNumber)->get('part')->row_array();

        // 将记录中的值转化为正确的单位
        $part['heatTemperature']        = $part['heatTemperature'] / 10;
        $part['heatDuration']           = $part['heatDuration'] / 10;
        $part['holdingPressure']        = $part['holdingPressure'] / 10;
        $part['holdingDuration']        = $part['holdingDuration'] / 10;
        $part['formingTemperature']     = $part['formingTemperature'] / 10;
        $part['demouldingTemperature']  = $part['demouldingTemperature'] / 10;
        $part['waterInletTemperature']  = $part['waterInletTemperature'] / 10;
        $part['waterOutletTemperature'] = $part['waterOutletTemperature'] / 10;
        $part['exposedDuration']        = $part['exposedDuration'] / 10;

        $result['part'] = $part;
        if (isset($robot))
        {
            foreach ($robot as $key => $value)
            {
                $value['totalTime'] = $value['totalTime'] /10;
                $value['velocity']  = $value['velocity'] /10;
                $robot[$key]        = $value;
            }
            $result['robot'] = $robot;
        }

        if (isset($press))
        {
            $press['velocity']         = $press['velocity'] / 10;
            $press['totalHoldingTime'] = $press['totalHoldingTime'] / 10;
            $press['totalTime']        = $press['totalTime'] / 10;
            $press['beat']             = $press['beat'] / 10;
            $result['press'] = $press;
        }

        return $result;

    }

    /**
     * 获得所有产品的信息
     *
     * getAllProduct
     * @param $per_page
     * @param $offset
     * @return Array $result 包含产品信息的数组
     */
    public function getAllProduct($per_page, $offset)
    {
        if ($offset > 0)
        {
            $offset = ($offset - 1) * $per_page;
        }
        $query = $this->db->order_by('createTime','DESC')->get('product', $per_page, $offset);
        $result = $query->result_array();
        return $result;
    }

    /**
     * 修改产品信息
     *
     * @param Array $data 包含产品信息的数组
     */
    public function fixProduct($data)
    {
        $query = $this->db->get_where('product', array('productNumber' => $data['productNumber']));
        if($query->num_rows() > 0 )
        {
            $this->db->where('productNumber', $data['productNumber']);
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->update('product', $data);
        }
        else
        {
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['createTime'] = date("Y-m-d H:i:s");
            $data['createPersonID'] = $_SESSION['account'];
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->insert('product', $data);
        }
    }

    /**
     * 获得所有工艺的信息
     *
     * getAllProcess
     * @param $per_page
     * @param $offset
     * @return Array $result 包含工艺信息的数组
     */
    public function getAllProcess($per_page, $offset)
    {
        if ($offset > 0)
        {
            $offset = ($offset - 1) * $per_page;
        }
        $query = $this->db->order_by('createTime','DESC')->get('process', $per_page, $offset);
        $result = $query->result_array();
        return $result;
    }

    /**
     * 修改工艺信息
     *
     * @param Array $data 包含产品信息的数组
     */
    public function fixProcess($data)
    {
        $query = $this->db->get_where('process', array('processNumber' => $data['processNumber']));
        if ($query->num_rows() > 0 )
        {
            $this->db->where('processNumber', $data['processNumber']);
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->update('process', $data);
        }
        else
        {
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['createTime'] = date("Y-m-d H:i:s");
            $data['createPersonID'] = $_SESSION['account'];
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->insert('process', $data);
        }
    }

    /**
     * 获得最近30个工艺
     */
    public function getRecentProcess()
    {
        $query = $this->db->order_by('createTime','DESC')->get('process',0, 30);
        $result = $query->result_array();
        return $result;
    }

    /**
     * 按天查看生产情况
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getproductionStatByDay($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        if (!empty($data['productNumber']))
        {
            $productNumber = $data['productNumber'];
            $sql = "SELECT date_format(`timestamp`,'%Y-%m-%d') AS time, count(*) as count
                    FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND productNumber = ".$this->db->escape($productNumber)." group by time";
        }
        else
        {
            $sql = "SELECT date_format(`timestamp`,'%Y-%m-%d') AS time, count(*) as count
                    FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' group by time";
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 按周查看生产情况
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getproductionStatByWeek($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        if (!empty($data['productNumber']))
        {
            $productNumber = $data['productNumber'];
            $sql = "SELECT date_format(`timestamp`,'%Y-%u') AS time, count(*) as count
                    FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND productNumber = ".$this->db->escape($productNumber)." group by time";
        }
        else
        {
            $sql = "SELECT date_format(`timestamp`,'%Y-%u') AS time, count(*) as count
                    FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' group by time";
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 按月查看生产情况
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getproductionStatByMonth($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        if (!empty($data['productNumber']))
        {
            $productNumber = $data['productNumber'];
            $sql = "SELECT date_format(`timestamp`,'%Y-%m') AS time, count(*) as count
                    FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND productNumber = ".$this->db->escape($productNumber)." group by time";
        }
        else
        {
            $sql = "SELECT date_format(`timestamp`,'%Y-%m') AS time, count(*) as count
                    FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' group by time";
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 按年查看生产情况
     * @param  object $data 时间范围对象
     * @return Array $result 数据库查询结果
     */
    public function getproductionStatByYear($data)
    {
        //开始时间
        $timeStart = $data['timeStart'];
        //结束时间
        $timeEnd = $data['timeEnd'];
        if (!empty($data['productNumber']))
        {
            $productNumber = $data['productNumber'];
            $sql = "SELECT date_format(`timestamp`,'%Y') AS time, count(*) as count
                    FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' AND productNumber = ".$this->db->escape($productNumber)." group by time";
        }
        else
        {
            $sql = "SELECT date_format(`timestamp`,'%Y') AS time, count(*) as count
                    FROM part WHERE `timestamp` BETWEEN '$timeStart' AND '$timeEnd' group by time";
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 获得今日产量、昨日产量、本周产量数据
     * @return 数组 包含今日产量、昨日产量、本周产量
     */
    public function getProductionStat()
    {
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('tomorrow'));
        $yesterday = date('Y-m-d', strtotime('yesterday'));
        $monday = date('Y-m-d', strtotime('last monday'));

        $sql = "SELECT productNumber, COUNT(*) AS count
                FROM part WHERE `timestamp` BETWEEN '$today' AND '$tomorrow' GROUP BY productNumber";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {
            $result['today'] = $query->result_array();
        }
        else
        {
            $result['today'] = 0;
        }

        $sql = "SELECT productNumber, COUNT(*) AS count
                FROM part WHERE `timestamp` BETWEEN '$yesterday' AND '$today' GROUP BY productNumber";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {
            $result['yesterday'] = $query->result_array();
        }
        else
        {
            $result['yesterday'] = 0;
        }

        $sql = "SELECT productNumber, COUNT(*) AS count
                FROM part WHERE `timestamp` BETWEEN '$monday' AND '$tomorrow' GROUP BY productNumber";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {
            $result['week'] = $query->result_array();
        }
        else
        {
            $result['week'] = 0;
        }
        return $result;
    }

}