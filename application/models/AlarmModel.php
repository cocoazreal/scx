<?php

class AlarmModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获得故障类型和描述
     *
     * @return Array
     */
    public function allAlarm()
    {
        $result = $this->db->get('alarm')->result_array();
        return $result;
    }
    /**
     * 获得设备故障的信息
     *
     * @param $data
     * @return Array $result
     */
    public function getAllAlarm($data)
    {
        $this->db->where('equipmentNumber', $data['equipmentNumber']);
        $this->db->where('alarmTime >=', $data['timeStart']);
        $this->db->where('alarmTime <=', $data['timeEnd']);
        $query = $this->db->get('alarm_record')->result_array();

        $result = array();
        $i = 0;
        foreach($query as $row)
        {
            $result[$i] = array();
            foreach($row as $element)
            {
                array_push($result[$i], $element);
            }
            $alarmNumber = $row['alarmNumber'];
            $this->db->select('description');
            $this->db->where('alarmNumber', $alarmNumber);
            $res = $this->db->get('alarm')->row_array();
            foreach($res as $element)
            {
                array_push($result[$i], $element);
            }
            $i++;
        }
        return $result;
    }

    /**
     *  获得设备故障统计信息
     *
     * @param $data
     * @return Array
     */
    public function getAlarmStat($data)
    {
        $equipmentNumber = $data['equipmentNumber'];
        $timeStart = $data['timeStart'];
        $timeEnd = $data['timeEnd'];
        $sql = "select count(*) as number, alarmNumber, alarmTime from alarm_record where equipmentNumber = '$equipmentNumber' AND (alarmTime BETWEEN '$timeStart' AND '$timeEnd') GROUP BY alarmNumber";
        $query = $this->db->query($sql)->result_array();

        $rs_number = array();
        $rs_alarmNumber = array();
        $rs_alarmName = array();
        $rs_time = array();

        //对数据进行编排 方便画图
        foreach($query as $row)
        {
            array_push($rs_number, $row['number']);
            array_push($rs_time, $row['alarmTime']);
            $alarmNumber = $row['alarmNumber'];
            $typeArray = $this->db->select('description')->where('alarmNumber', $alarmNumber)->get('alarm')->row_array();
            array_push($rs_alarmNumber, $alarmNumber);
            array_push($rs_alarmName, $typeArray['description']);
        }

        $result = array(
            'count' => $rs_number,
            'time' => $rs_time,
            'name' => $rs_alarmName,
            'number' => $rs_alarmNumber
        );

        return $result;
    }
}