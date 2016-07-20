<?php

class OthersModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *获得所有材料的信息
     * @param $per_page 每页条数
     * @param $offset 偏移量
     * @return Array $result 包含材料信息
     */
    public function getAllMaterial($per_page, $offset)
    {
        if ($offset > 0)
        {
            $offset = ($offset - 1) * $per_page;
        }
        $query = $this->db->order_by('createTime', 'DESC')->get('material', $per_page, $offset);
        $result = $query->result_array();
        return $result;
    }

    /**
     * 修改材料所有的信息
     *
     * @param Array $data 材料信息
     */
    public function fixMaterial($data)
    {
        $query = $this->db->get_where('material', array('materialNumber' => $data['materialNumber']));
        if ($query->num_rows() > 0 )
        {
            $this->db->where('materialNumber', $data['materialNumber']);
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->update('material', $data);
        }
        else
        {
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['createTime'] = date("Y-m-d H:i:s");
            $data['createPersonID'] = $_SESSION['account'];
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->insert('material', $data);
        }
    }

    /**
     * 获得最近30个材料
     */
    public function getRecentMaterial()
    {
        $query = $this->db->order_by('createTime','DESC')->get('material',0, 30);
        $result = $query->result_array();
        return $result;
    }

    /**
     * 获得所有模具的信息
     */
    public function getAllMould($per_page, $offset)
    {
        if ($offset > 0)
        {
            $offset = ($offset - 1) * $per_page;
        }
        $query = $this->db->order_by('createTime', 'DESC')->get('mould', $per_page, $offset);
        $result = $query->result_array();
        return $result;
    }

    /**
     * 修改模具所有的信息
     *
     * @param Array $data 模具信息
     */
    public function fixMould($data)
    {
        $query = $this->db->get_where('mould', array('mouldNumber' => $data['mouldNumber']));
        if ($query->num_rows() > 0 )
        {
            $this->db->where('mouldNumber', $data['mouldNumber']);
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->update('mould', $data);
        }
        else
        {
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['createTime'] = date("Y-m-d H:i:s");
            $data['createPersonID'] = $_SESSION['account'];
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->insert('mould', $data);
        }
    }

    /**
     * 获得最近30个模具
     */
    public function getRecentMould()
    {
        $query = $this->db->order_by('createTime','DESC')->get('mould',0, 30);
        $result = $query->result_array();
        return $result;
    }

    /*
     * 获取所有厂商的信息
     */
    public function getAllCompany($per_page, $offset)
    {
        if ($offset > 0)
        {
            $offset = ($offset - 1) * $per_page;
        }
        $query = $this->db->order_by('createTime', 'DESC')->get('company',$per_page, $offset);
        $result = $query->result_array();
        return $result;
    }

    /**
     * 修改厂商所有的信息
     *
     * @param Array $data 厂商信息
     */
    public function fixCompany($data)
    {
        $query = $this->db->get_where('company', array('companyNumber' => $data['companyNumber']));
        if ($query->num_rows() > 0 )
        {
            $this->db->where('companyNumber', $data['companyNumber']);
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->update('company', $data);
        }
        else
        {
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['createTime'] = date("Y-m-d H:i:s");
            $data['createPersonID'] = $_SESSION['account'];
            $data['updateTime'] = date("Y-m-d H:i:s");
            $data['updatePersonID'] = $_SESSION['account'];
            $data = array_map('trim', $data);
            $this->db->insert('company', $data);
        }
    }

    /**
     * 获得最近30个厂商
     */
    public function getRecentCompany()
    {
        $query = $this->db->order_by('createTime','DESC')->get('company',0, 30);
        $result = $query->result_array();
        return $result;
    }

    /*
     * 获得所有设备的信息
     */
    public function getAllEquipment()
    {
        $query = $this->db->get('equipment');
        $result = $query->result_array();
        return $result;
    }

    /*
     * 修改设备所有信息
     *
     * @param Array $data 设备信息
     */
    public function fixEquipment($data)
    {
        $this->db->where('equipmentNumber', $data['equipmentNumber']);
        $this->db->update('equipment', $data);
    }

}