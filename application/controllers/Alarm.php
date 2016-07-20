<?php

class Alarm extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("alarmmodel");
        $this->load->model('person');
    }

    public function index(){}

    /**
     *  显示所有的故障
     */
    public function allAlarm()
    {
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        $result = $this->alarmmodel->allAlarm();
        $type['type'] = $result;
        $this->load->view('alarm_type', $type);

    }

    /**
     *  获得所有故障
     */
    public function showAllAlarm()
    {
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        $getData = $this->input->post() ? $this->input->post() : array();
        $data = array_map('trim', $getData);
        if(empty($data))
        {
            $this->load->view('alarm_history');
        }
        else
        {
            $result = $this->alarmmodel->getAllAlarm($data);
            $alarm['alarm'] = $result;

            $this->load->view('alarm_history', $alarm);
        }
    }

    /**
     *  统计故障表单
     */
    public function showAlarmStat()
    {
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        $getData = $this->input->post() ? $this->input->post() : array();
        $data = array_map('trim', $getData);

        if(empty($data))
        {
            $this->load->view('alarm_statistics');
        }
        else
        {
            $result = $this->alarmmodel->getAlarmStat($data);
            $alarm['alarm'] = $result;
            $this->load->view('alarm_statistics', $alarm);
        }

    }



}