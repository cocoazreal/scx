<?php
/**
 * Created by PhpStorm.
 * User: Kuan.C
 * Date: 2015/8/27
 * Time: 16:50
 */

class Person extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //加载数据库模块
        $this->load->database();
    }

    /**
     * isRight
     *
     * 首先判断用户是否存在 若不存在直接返回
     * 若存在则判断密码是否相同 不同exit
     *
     * @param array $data 用户的信息
     * @return bool 是否成功
     */
    public function isRight($data)
    {
        //查询是否有该用户名
        $query = $this->db->get_where('person', array('account' => $data['account']));
        if($query->num_rows() > 0)
        {
            //取到数据，将数据转为数组
            $user = $query->row();
            if($user->password == $data['password'])
            {
                return 1;
            }
            else return 0;
        }
        else return 0;
    }

    /**
     *getAllInfo
     *
     * 获取用户所有信息
     *
     * @param string account 用户号
     * @return Object $userInfo 用户信息
     */
    public function getAllInfo($account)
    {
        $query = $this->db->get_where('person', array('account' => $account));
        $result = $query->row();
        if($result)
        {
            $personInfo['name'] = $result->name;
            $personInfo['password'] = $result->password;
            $personInfo['account'] = $result->account;
            $personInfo['usergroup'] = $result->userGroup;
            $personInfo['department'] = $result->department;
            $personInfo['telephone'] = $result->telephone;
            $personInfo['createtime'] = $result->creatTime;
            return $personInfo;
        }
        else exit;
    }

    /**
     * updateData
     *
     * 插入数据
     *
     * @param Array data 用户信息
     *
     */
    public function updateData($data)
    {
        $this->db->where('account', $data['account']);
        $this->db->update('person', $data);
    }

    /**
     * 获取所有用户的信息
     *
     * @return Array $allUser 用户信息
     */
    public function allUserData()
    {
        $query = $this->db->query("SELECT * FROM person;");
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            exit;
        }
    }

    /**
     * 插入用户信息
     *
     * insertUser
     *
     * @param Array $data 用户
     *
     */
    public function insertUser($data)
    {
        $query = $this->db->get_where('person', array('account' => $data['account']));
        if($query->num_rows() > 0 )
        {
            $this->db->where('account', $data['account']);
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data = array_map('trim', $data);
            $this->db->update('person', $data);
        }
        else
        {
            $data['timestamp'] = date("Y-m-d H:i:s");
            $data['creatTime'] = date("Y-m-d H:i:s");
            $data = array_map('trim', $data);
            $this->db->insert('person', $data);
        }

    }
}