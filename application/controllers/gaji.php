<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Gaji extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_gaji');
        define('key', 'idgaji');
        $this->is_logged();
    }

    public function data($data)
    {
        $a_data['input'][] = array('key' => 'idgaji', 'label' => 'Kode', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'sektorpekerjaan', 'label' => 'Pekerjaan', 'type' => 'T', 'hidden' => false, 'readonly' => true);
        $a_data['input'][] = array('key' => 'nominal', 'label' => 'Nominal', 'type' => 'N', 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'gaji';
        $a_data['label'] = 'Data Gaji';
        $a_data['p_key'] = 'idgaji';

        //variabel request
        $this->load->model('m_auth');
        $a_auth = $this->m_auth->role();

        $a_data['c_insert'] = $a_auth['c_insert'];
        $a_data['c_edit'] = $a_auth['c_edit'];
        $a_data['c_delete'] = $a_auth['c_delete'];
        
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