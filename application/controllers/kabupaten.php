<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Kabupaten extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_kabupaten');
        define('key', 'idkabupaten');
        define('parentkey', 'idprovinsi');
        $this->is_logged();
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $provinsi = $this->m_combo->provinsi();

        $a_data['input'][] = array('key' => 'idkabupaten', 'label' => 'Id Kabupaten', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'kodekabupaten', 'label' => 'Kode Kabupaten', 'type' => 'T', 'hidden' => false, 'readonly' => true);
        $a_data['input'][] = array('key' => 'idprovinsi', 'label' => 'Provinsi', 'type' => 'S', 'option' => $provinsi, 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'namakabupaten', 'label' => 'Nama Kabupaten', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'kabupaten';
        $a_data['label'] = 'Data Kabupaten';
        $a_data['p_key'] = 'idkabupaten';

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

    public function add()
    {
        $data = $this->input->post();
        $data['idkabupaten'] = $data['kodekabupaten'] . "_" . $data['idprovinsi'];
        $this->load->model(model);
        $data = $this->{model}->reduce($data);
        $a_data = $this->{model}->add($data);
        $this->getall($a_data);
    }
}