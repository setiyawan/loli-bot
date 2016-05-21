<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Desa extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_desa');
        define('key', 'iddesa');
        define('parentkey', 'idkecamatan');
        $this->is_logged();
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $provinsi = $this->m_combo->provinsi();
        $kabupaten = $this->m_combo->kabupaten();
        $kecamatan = $this->m_combo->kecamatan();

        $a_data['input'][] = array('key' => 'iddesa', 'label' => 'Id Desa', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'idprovinsi', 'label' => 'Provinsi', 'type' => 'S', 'option' => $provinsi, 'hidden' => true, 'readonly' => false, 'add' => 'onchange="changekabupaten(this)"');
        $a_data['input'][] = array('key' => 'idkabupaten', 'label' => 'Kabupaten', 'type' => 'S', 'option' => $kabupaten, 'hidden' => true, 'readonly' => false, 'add' => 'onchange="changekecamatan(this)"');
        $a_data['input'][] = array('key' => 'idkecamatan', 'label' => 'Kecamatan', 'type' => 'S', 'option' => $kecamatan, 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'namadesa', 'label' => 'Nama Desa', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'kodedesa', 'label' => 'Kode Desa', 'type' => 'T', 'hidden' => false, 'readonly' => true);
        $a_data['script'] = 'desa';
        $a_data['label'] = 'Data Desa';
        $a_data['p_key'] = 'iddesa';

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
        $tmp = "";
        $this->is_logged();
        $data = $this->input->post();
        //if($data['kodekecamatan'] < 100) $tmp = "0";
        $data['iddesa'] = $tmp . $data['kodedesa'] . "_" . $data['idkecamatan'];
        $this->load->model(model);
        $data = $this->{model}->reduce($data);
        $a_data = $this->{model}->add($data);
        $this->getall($a_data);
    }
}