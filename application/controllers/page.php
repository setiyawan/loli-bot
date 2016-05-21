<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Page extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_page');
        define('key', 'idpage');
        $this->is_logged();
    }

    public function data($data)
    {
        $a_data['input'][] = array('key' => 'idpage', 'label' => 'Id Page', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'page', 'label' => 'Nama Halaman', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'page';
        $a_data['label'] = 'Daftar Halaman';
        $a_data['p_key'] = 'idpage';

        //variabel request
        $a_data['c_insert'] = true;
        $a_data['c_edit'] = true;
        $a_data['c_delete'] = true;
        return array_merge($data, $a_data);
    }

    public function input($a_data)
    {
    	$a_data = $this->data($a_data);

        $this->load->view('header');
        $this->load->view('inc_data-01', $a_data);
        $this->load->view('footer');
    }
}