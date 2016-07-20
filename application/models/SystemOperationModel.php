<?php

class SystemOperationModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){}

    /**
     * 获取操作类型的信息
     * @return mixed
     */
    public function getAllOperation()
    {
        $query = $this->db->get('system_operation')->result_array();
        return $query;
    }

    /**
     * 获得操作记录
     *
     * @return mixed
     */
    public function getAllOperationRecord()
    {
        $query = $this->db->get('system_operation_record')->result_array();

        $result = array();

        foreach($query as $row)
        {
            $operationNumber = $row['operationNumber'];
            $this->db->select('operationName');
            $this->db->where('operationNumber', $operationNumber);
            $res = $this->db->get('system_operation')->row_array();
            $row['operationName'] = $res['operationName'];
            array_push($result, $row);
        }
        return $result;
    }

    public function getDoorRecord()
    {
        $query = $this->db->get('safety_door')->result_array();

        return $query;
    }
}