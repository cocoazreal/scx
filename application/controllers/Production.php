<?php

class Production extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('productionmodel');
        $this->load->model('person');
    }

    /**
     * 零件列表头
     */
    public function  allPart()
    {
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);
        $this->load->view('part');
    }

    /**
     * 零件列表详细信息
     */
    public  function getAllPart()
    {
        //  获得post数据
        $getData = $this->input->post() ? $this->input->post() : array();
        $data = array_map('trim', $getData);
        $account = $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);
        if (empty($data['id'])) {
            $result = $this->productionmodel->getPartByTime($data);
            $production['part'] = $result;
            $this->load->view('part', $production);
        } else {
            $result = $this->productionmodel->getPartById($data);
            $production['part'] = $result;
            $this->load->view('part', $production);
        }
    }

    /**
     * 单个零件详细信息
     */
    public function getPartInfo($partNumber)
    {
        $partInfo = $this->productionmodel->getPartInfoByID($partNumber);
        $account =  $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);
        $this->load->view('part_info', $partInfo);
    }

    /**
     * 显示所有产品
     */
    public function showAllProduct()
    {
        $account = $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        //调用分页
        $this->pages->pages('product', '/index.php/production/showAllProduct/');

        //第一个参数为每页个数,第二个为页数
        $result = $this->productionmodel->getAllProduct($this->config->item('per_page'), $this->uri->segment(3));

        $production['product'] = $result;
        $this->load->view('product', $production);
    }


    /**
     * 修改产品信息
     */
    public function fixProduction()
    {
        $getData = $this->input->post() ? $this->input->post() : array();
        $data = array_map('trim', $getData);
        $data['length'] = $data['length'] * 10;
        $data['width'] = $data['width'] * 10;
        $data['thickness'] = $data['thickness'] * 10;
        $data['blankWeight'] = $data['blankWeight'] * 10;
        $data['productWeight'] = $data['productWeight'] * 10;
        $data['yieldStrength'] = $data['yieldStrength'] * 10;
        $data['tensileStrength'] = $data['tensileStrength'] * 10;
        $data['elongation'] = $data['elongation'] * 10;
        $this->productionmodel->fixProduct($data);
        $this->showAllProduct();
    }

    /**
     * 显示所有的工艺
     */
    public function showAllProcess()
    {
        $account = $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        //调用分页
        $this->pages->pages('process', '/index.php/production/showAllProcess/');

        //第一个参数为每页个数,第二个为页数
        $result = $this->productionmodel->getAllProcess($this->config->item('per_page'), $this->uri->segment(3));

        $process['process'] = $result;
        $this->load->view('process', $process);
    }

    /**
     * 修改工艺信息
     */
    public function fixProcess()
    {
        $getData = $this->input->post() ? $this->input->post() : array();
        $data = array_map('trim', $getData);
        $data['heatTemperature'] = $data['heatTemperature'] * 10;
        $data['heatDuration'] = $data['heatDuration'] * 10;
        $data['formingTemperature'] = $data['formingTemperature'] * 10;
        $data['demouldingTemperature'] = $data['demouldingTemperature'] * 10;
        $data['waterInletTemperature'] = $data['waterInletTemperature'] * 10;
        $data['waterOutletTemperature'] = $data['waterOutletTemperature'] * 10;
        $data['waterFlow'] = $data['waterFlow'] * 10;
        $data['holdingPresssure'] = $data['holdingPresssure'] * 10;
        $data['holdingDuration'] = $data['holdingDuration'] * 10;
        $data['formingRate'] = $data['formingRate'] * 10;
        $this->productionmodel->fixProcess($data);
        $this->showAllProcess();
    }

    /**
     * 显示最近30个工艺
     */
    public function recentProcess()
    {
        $result = $this->productionmodel->getRecentProcess();

        echo "<ul class='select-list'>";
        for($i = 0; $i < count($result); $i++)
        {
            echo "<li><a href='#' onclick='selectProcess(this)'>". $result[$i]['processNumber'] ."</a></li>";
        }
        echo "<ul>";
    }
    /**
     * 显示生产统计
     */
    public function showStat()
    {
        $account = $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);
        $this->load->view('production_statistics');
    }

    /**
     * 显示生产统计数据
     */
    public function getStatData()
    {
        $getData = $this->input->post()?$this->input->post():array();
        $data = array_map('trim', $getData);
        if ($data['view'] === 'day')
        {
            $result = $this->productionmodel->getproductionStatByDay($data);
        }
        else if ($data['view'] === 'week')
        {
            $data['timeStart'] = date('Y-m-d',strtotime('last Monday',strtotime($data['timeStart'])));
            $data['timeEnd'] = date('Y-m-d',strtotime('next Sunday',strtotime($data['timeEnd'])));
            $result = $this->productionmodel->getproductionStatByWeek($data);
        }
        else if ($data['view'] === 'month')
        {
            $data['timeStart'] = date('Y-m-01',strtotime($data['timeStart']));
            $data['timeEnd'] = date('Y-m-d',strtotime(date('Y-m-01',strtotime($data['timeEnd']))." +1 month -1 day"));
            $result = $this->productionmodel->getproductionStatByMonth($data);
        }
        else
        {
            $data['timeStart'] = substr($data['timeStart'],0,4).'-01-01';
            $data['timeEnd'] = substr($data['timeEnd'],0,4).'-12-31';
            $result = $this->productionmodel->getproductionStatByYear($data);
        }
        $time = array();
        $count = array();
        foreach ($result as $value)
        {
            array_push($time, $value['time']);
            array_push($count, $value['count']);
        }
        $data['time'] = $time;
        $data['count'] = $count;

        $account = $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);
        $this->load->view('production_statistics', $data);
    }
}