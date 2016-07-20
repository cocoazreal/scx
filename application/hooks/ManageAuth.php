<?php
/**
 * 后台权限拦截钩子
 */
class ManageAuth
{
	private $CI;
	public function __construct()
	{
		$this->CI = &get_instance();
	}

    /**
     * 权限认证
     * @return [type] [description]
     */
    public function auth()
    {
    	$this->CI->load->helper('url');
    	if (preg_match("/login$|home$/i", uri_string()))
    	{
    		return;
    	}
    	if(!isset($_SESSION['account']))
    	{
			// 用户未登陆
    		redirect("login");
    		return;
    	}
    }
}
