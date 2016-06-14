<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Keluarga extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_keluarga');
        define('key', 'idkeluarga');
        define('parentkey', 'iddesa');
        $this->is_logged();
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $provinsi = $this->m_combo->provinsi();
        $kabupaten = $this->m_combo->kabupaten();
        $kecamatan = $this->m_combo->kecamatan();
        $desa = $this->m_combo->desa();

        $a_data['input'][] = array('key' => 'idkeluarga', 'label' => 'Id Keluarga', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'idprovinsi', 'label' => 'Provinsi', 'type' => 'S', 'option' => $provinsi, 'hidden' => true, 'readonly' => false, 'add' => 'onchange="changekabupaten(this)" onload="firstload(this)"');
        $a_data['input'][] = array('key' => 'idkabupaten', 'label' => 'Kabupaten', 'type' => 'S', 'option' => $kabupaten, 'hidden' => true, 'readonly' => false, 'add' => 'onchange="changekecamatan(this)"');
        $a_data['input'][] = array('key' => 'idkecamatan', 'label' => 'Kecamatan', 'type' => 'S', 'option' => $kecamatan, 'hidden' => true, 'readonly' => false, 'add' => 'onchange="changedesa(this)"');
        $a_data['input'][] = array('key' => 'iddesa', 'label' => 'Desa', 'type' => 'S', 'option' => $desa, 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'alamat', 'label' => 'Alamat', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'nama', 'label' => 'Nama', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'keluarga';
        $a_data['label'] = 'Target Keluarga Yang Akan Disurvey';
        $a_data['p_key'] = 'idkeluarga';

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
        $this->load->model(model);
        $data = $this->{model}->reduce($data);
        $a_data = $this->{model}->add($data);
        $this->getall($a_data);
    }
}