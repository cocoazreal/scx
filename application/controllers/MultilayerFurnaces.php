<?php
/**
 * Created by PhpStorm.
 * User: Kuan.C
 * Date: 2015/8/29
 * Time: 15:35
 */

class MultilayerFurnaces extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('multilayer');
        $this->load->model('person');
    }

    public function index()
    {
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);

        $result = $this->multilayer->getTodayHistoryData();

        $this->load->view('header', $userdata);
        $this->load->view('multilayer_history', $result);
    }

    public function getHistoryData()
    {
        $getData = $this->input->post()?$this->input->post():array();
        $data = array_map('trim', $getData);
        $result = $this->multilayer->getAll($data);

        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);

        $this->load->view('header', $userdata);
        $this->load->view("multilayer_history", $result);
    }

    public function getNowData()
    {
        $result = $this->multilayer->getAllNow();
        $mul['nowData'] = $result;
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);

        $this->load->view('header', $userdata);
        $this->load->view("multilayer_now", $mul);
    }

    public function  showStat()
    {

        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);

        $this->load->view('header', $userdata);
        $this->load->view('multilayer_statistics');
    }

    public function  getStatData()
    {
        $getData = $this->input->post()?$this->input->post():array();
        $data = array_map('trim', $getData);
        if ($data['view'] === 'default')
        {
            switch ($data['category'])
            {
                case 'heatingTime':
                    $result = $this->multilayer->getHeatingTime($data);
                    break;
                case 'largerTime':
                    $result = $this->multilayer->getLargerTime($data);
                    break;
                case 'usageRates':
                    $result = $this->multilayer->getUsageRates($data);
                    break;
                case 'heatingCount':
                    $result = $this->multilayer->getHeatingCount($data);
                    break;
                default:
                    break;
            }
            $emptyArray = array('-');
            for ($i=1; $i <= $this->config->item('furnacesNumber'); $i++) {
                $furnaces[$i + 10] = $emptyArray;
            }
            for ($i=1; $i <= $this->config->item('furnacesNumber'); $i++) {
                $furnaces[$i + 20] = $emptyArray;
            }
            $resultCount = 0;
            for ($i=1; $i <= $this->config->item('furnacesNumber') * 2; $i++)
            {
                if ($i <= $this->config->item('furnacesNumber'))
                {
                    if ($result[$resultCount]['furnaceNumber'] === (string)($i + 10))
                    {
                        $furnaces[$i + 10][0] = $result[$resultCount]['count'];
                        $resultCount++;
                    }
                }
                else
                {
                    if ($result[$resultCount]['furnaceNumber'] === (string)($i + 13))
                    {
                        $furnaces[$i + 13][0] = $result[$resultCount]['count'];
                        $resultCount++;
                    }
                }
                if ($resultCount >= count($result))
                {
                    break;
                }
            }
            $time = array('一段时间内的频次或使用率');
        }
        else if ($data['view'] === 'day')
        {
            switch ($data['category'])
            {
                case 'heatingTime':
                    $result = $this->multilayer->getHeatingTimeByDay($data);
                    break;
                case 'largerTime':
                    $result = $this->multilayer->getLargerTimeByDay($data);
                    break;
                case 'usageRates':
                    $result = $this->multilayer->getUsageRatesByDay($data);
                    break;
                case 'heatingCount':
                    $result = $this->multilayer->getHeatingCountByDay($data);
                    break;
                default:
                    break;
            }

            // 获得所有需要显示的天
            $time = array();
            foreach ($result as $value)
            {
                array_push($time, $value['time']);
            }
            $time = array_values(array_unique($time));

            $emptyArray = array();
            for ($i=0; $i < count($time); $i++) {
                array_push($emptyArray, '-');
            }
            for ($i=1; $i <= $this->config->item('furnacesNumber'); $i++) {
                $furnaces[$i + 10] = $emptyArray;
            }
            for ($i=1; $i <= $this->config->item('furnacesNumber'); $i++) {
                $furnaces[$i + 20] = $emptyArray;
            }
            $resultCount = 0;
            foreach ($time as $key => $value) {
                for ($i=1; $i <= $this->config->item('furnacesNumber') * 2; $i++) {
                    if ($i <= $this->config->item('furnacesNumber')) {
                        if ($result[$resultCount]['furnaceNumber'] === (string)($i + 10)
                            && $result[$resultCount]['time'] === $value) {
                            $furnaces[$i + 10][(int)$key] = $result[$resultCount]['count'];
                            $resultCount++;
                        }
                    }
                    else {
                        if ($result[$resultCount]['furnaceNumber'] === (string)($i + 13)
                            && $result[$resultCount]['time'] === $value) {
                            $furnaces[$i + 13][(int)$key] = $result[$resultCount]['count'];
                            $resultCount++;
                        }
                    }
                    if ($resultCount >= count($result)) {
                        break;
                    }
                }
            }
        }
        $data['time'] = $time;
        $data['furnaces'] = $furnaces;
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);
        $this->load->view('multilayer_statistics', $data);
    }
}