<?php
/**
 * Created by PhpStorm.
 * User: Kuan.C
 * Date: 2015/8/27
 * Time: 16:06
 */

class Home extends CI_Controller {

    /**
     * __construct
     *
     *构造方法
     */
    public function  __construct()
    {
        parent::__construct();
        $this->load->model('person');
        $this->load->model('productionmodel');
    }



    /**
     * index
     *
     * 接受用户提交的信息 并判断
     */
    public function index()
    {
        //获取用户提交的信息
        $postData = $this->input->post()?$this->input->post():array();
        //去除提交数据中的空格
        $data = array_map('trim', $postData);

        //非提交表单形式访问直接拒绝
        if(!isset($data['account']))
        {
            if(isset($_SESSION['account']))
            {
                //在首页中存入个人信息
                $userData = $this->user($_SESSION['account']);

                //传入数据
                $this->load->view("header",$userData);

                // 获得今日
                $result = $this->productionmodel->getProductionStat();
                $this->load->view("index", $result);
            }
            else
            {
                $this->load->view("login");
            }
        }
        else
        {
            //判断
            $result = $this->person->isRight($data);
            if($result)
            {
                //获得用户编号
                $account = $data['account'];

                //将account保存到session中
                $_SESSION['account'] = $account;

                //在首页中存入个人信息
                $userData = $this->user($account);

                //传入数据
                $this->load->view("header",$userData);

                // 获得今日
                $result = $this->productionmodel->getProductionStat();
                $this->load->view("index", $result);
            }
            else
            {
                $this->load->view("login");
            }
        }

    }

    /**
     * user
     *
     * 根据用户工号获取用户全部信息
     *
     * @param string account 用户号
     * @return Array personInfo 用户信息
     */
    public function user($account)
    {
        $user = $this->person->getAllInfo($account);
        return $user;
    }

    /**
     * fixInfo
     *
     * 修改用户信息
     */
    public function fixInfo()
    {
        $postData = $this->input->post()?$this->input->post():array();
        //去除提交数据中的空格
        $data = array_map('trim', $postData);
        if( empty($data['name']) || empty($data['department']) || empty($data['telephone']) )
        {
            $this->load->view('fail');
        }
        else
        {
            $this->person->updateData($data);
            $this->load->view("login");
        }
    }

    /**
     * showAllUser
     *
     * 显示所有用户
     *
     */
    public function showAllUser()
    {
        if(isset($_SESSION['account']) && $this->user($_SESSION['account'])['usergroup'] == 12)
        {
            $allUserData = $this->person->allUserData();
            $allUser['allUserData'] = $allUserData;
            $this->load->view("allUser", $allUser);
        }
        else
        {
            $this->load->view("login");
        }
    }

    /**
     * insertNewUser
     *
     * 添加新用户
     */
    public function insertNewUser()
    {
        //获取用户提交的信息
        $postData = $this->input->post()?$this->input->post():array();
        //去除提交数据中的空格
        $data = array_map('trim', $postData);

        $this->person->insertUser($data);
        echo "<script>history.back();</script>";
    }

}