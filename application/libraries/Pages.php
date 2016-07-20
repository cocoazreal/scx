<?php

class Pages {

    public function __construct()
    {
    }


    public function pages($table, $link)
    {
        $CI =& get_instance();
        $total = $CI->db->count_all($table);

        //给分页类设置参数
        $config['base_url'] = $link;
        $config['total_rows'] = $total;
        $config['per_page'] = $CI->config->item('per_page');
        //链接嵌套
        $config['full_tag_open'] = '<div class="container-fluid"><div  style="text-align: center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div></div>';
        //当前链接
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        //数字链接
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        //最后一页 开始一页
        $config['last_link'] = '>>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = '<<';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        //上下页链接
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';


        $CI->pagination->initialize($config);
    }
}