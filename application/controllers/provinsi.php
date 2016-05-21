<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Provinsi extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_provinsi');
        define('key', 'idprovinsi');
        $this->is_logged();
    }

    public function data($data)
    {
        $a_data['input'][] = array('key' => 'idprovinsi', 'label' => 'Id Provinsi', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'kodeprovinsi', 'label' => 'Kode Provinsi', 'type' => 'T', 'hidden' => false, 'readonly' => true);
        $a_data['input'][] = array('key' => 'namaprovinsi', 'label' => 'Nama Provinsi', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'provinsi';
        $a_data['label'] = 'Data Provinsi';
        $a_data['p_key'] = 'idprovinsi';

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
        $this->is_logged();
        $data = $this->input->post();
        $data['idprovinsi'] = $data['kodeprovinsi'];
        $this->load->model(model);
        $data = $this->{model}->reduce($data);
        $a_data = $this->{model}->add($data);
        $this->getall($a_data);
    }
}