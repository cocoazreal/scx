<?php

class Others extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('othersmodel');
        $this->load->model('person');
    }

    public function index()
    {

    }

    /**
     * 获取所有的材料
     */
    public function showAllMaterial()
    {
        $account = $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        //调用分页 第一参数表名 第二个参数首页地址
        $this->pages->pages('material', '/index.php/others/showAllMaterial/');

        //第一个参数为每页个数,第二个为页数
        $result = $this->othersmodel->getAllMaterial($this->config->item('per_page'), $this->uri->segment(3));

        $res['material'] = $result;
        $this->load->view('material', $res);
    }

    /**
     * 修改材料的信息
     */
    public function fixMaterial()
    {
        $getData = $this->input->post() ? $this->input->post() : array();
        $data = array_map('trim', $getData);
        $data['comingWeight'] = $data['comingWeight'] * 10;
        $data['length'] = $data['length'] * 10;
        $data['width'] = $data['width'] * 10;
        $data['thickness'] = $data['thickness'] * 10;
        $this->othersmodel->fixMaterial($data);
        $this->showAllMaterial();
    }

    /**
     * 显示最近30个材料
     */
    public function recentMaterial()
    {
        $result = $this->othersmodel->getRecentMaterial();

        echo "<ul class='select-list'>";
        for($i = 0; $i < count($result); $i++)
        {
            echo "<li><a href='#' onclick='selectMaterial(this)'>". $result[$i]['materialNumber'] ."</a></li>";
        }
        echo "<ul>";
    }

    /**
     * 获取所有的模具
     */
    public function showAllMould()
    {
        $account = $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);


        //调用分页
        $this->pages->pages('mould', '/index.php/others/showAllMould/');

        //第一个参数为每页个数,第二个为页数
        $result = $this->othersmodel->getAllMould($this->config->item('per_page'), $this->uri->segment(3));

        $res['mould'] = $result;

        $this->load->view('mould', $res);
    }

    /**
     * 修改模具的信息
     */
    public function fixMould()
    {
        $getData = $this->input->post() ? $this->input->post() : array();
        $data = array_map('trim', $getData);
        $data['length'] = $data['length'] * 10;
        $data['width'] = $data['width'] * 10;
        $data['height'] = $data['height'] * 10;
        $data['totalWeight'] = $data['totalWeight'] * 10;
        $data['upperMoldWeight'] = $data['upperMoldWeight'] * 10;
        $data['bottomMoldWeight'] = $data['bottomMoldWeight'] * 10;
        $this->othersmodel->fixMould($data);
        $this->showAllMould();
    }

    /**
     * 显示最近30个模具
     */
    public function recentMould()
    {
        $result = $this->othersmodel->getRecentMould();

        echo "<ul class='select-list'>";
        for($i = 0; $i < count($result); $i++)
        {
            echo "<li><a href='#' onclick='selectMould(this)'>". $result[$i]['mouldNumber'] ."</a></li>";
        }
        echo "</ul>";
    }

    /*
     *获取厂商的信息
     */
    public function showAllCompany()
    {
        $account = $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        //调用分页
        $this->pages->pages('company', '/index.php/others/showAllCompany/');

        //第一个参数为每页个数,第二个为页数
        $result = $this->othersmodel->getAllCompany($this->config->item('per_page'), $this->uri->segment(3));

        $res['company'] = $result;
        $this->load->view('company', $res);
    }

    /*
     * 修改厂商信息
     *
     * @param Array $data
     */
    public function fixCompany()
    {
        $getData = $this->input->post() ? $this->input->post() : array();
        $data = array_map('trim', $getData);
        $this->othersmodel->fixCompany($data);
        $this->showAllCompany();
    }

    /**
     * 显示最近30个厂商
     */
    public function recentCompany()
    {
        $result = $this->othersmodel->getRecentCompany();

        echo "<ul class='select-list'>";
        for($i = 0; $i < count($result); $i++)
        {
            echo "<li><a href='#' onclick='selectCompany(this)'>". $result[$i]['companyNumber'] ."</a></li>";
        }
        echo "<ul>";
    }

    /*
     * 获得所有设备信息
     */
    public function showAllEquipment()
    {
        $account = $_SESSION['account'];
        $userdata = $this->person->getAllInfo($account);
        $this->load->view('header', $userdata);

        $equipment = $this->othersmodel->getAllEquipment();
        $res['equipment'] = $equipment;
        $this->load->view('equipment', $res);
    }

    /*
     * 修改设备所有信息
     */
    public function fixEquipment()
    {
        $getData = $this->input->post() ? $this->input->post() : array();
        $data = array_map('trim', $getData);
        $this->othersmodel->fixEquipment($data);
        $this->showAllEquipment();
    }

}