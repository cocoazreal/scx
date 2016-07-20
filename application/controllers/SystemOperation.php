<?php

class SystemOperation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('systemoperationmodel');
        $this->load->model('person');
    }

    public function index(){}

    /**
     * 获取所有的操作类型
     */
    public function getAllOperation()
    {
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        $result = $this->systemoperationmodel->getAllOperation();
        $res['operation'] = $result;
        $this->load->view('operation_type', $res);
    }

    /**
     * 获取所有的操作记录
     */
    public function getAllOperationRecord()
    {
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        $result = $this->systemoperationmodel->getAllOperationRecord();
        $res['operation'] = $result;
        $this->load->view('operation_record', $res);
    }

    /**
     * 获取安全门的操作记录
     */
    public function getDoorRecord()
    {
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        $result = $this->systemoperationmodel->getDoorRecord();
        $res['door'] = $result;
        $this->load->view('door', $res);
    }
}