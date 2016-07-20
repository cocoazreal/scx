<?php
/**
 * Created by PhpStorm.
 * User: Kuan.C
 * Date: 2015/8/27
 * Time: 16:30
 */

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public  function index()
    {
    	session_destroy();
        $this->load->view('login');
    }
}