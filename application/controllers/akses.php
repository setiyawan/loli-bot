<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Akses extends C_controller
{
    public function __construct()
    {
        parent::__construct();
        define('model', 'M_akses');
        define('key', 'idakses');
        $this->is_logged();
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $akun = $this->m_combo->akun(true);
        $provinsi = $this->m_combo->provinsi();
        $kabupaten = $this->m_combo->kabupaten();
        $kecamatan = $this->m_combo->kecamatan();
        $desa = $this->m_combo->desa();

        $a_data['input'][] = array('key' => 'idakses', 'label' => 'Id Akses', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'idakun', 'label' => 'Nama Akun', 'type' => 'S', 'option' => $akun, 'hidden' => false, 'readonly' => true);
        $a_data['input'][] = array('key' => 'idprovinsi', 'label' => 'Provinsi', 'type' => 'S', 'option' => $provinsi, 'hidden' => true, 'readonly' => false, 'add' => 'onchange="changekabupaten(this)"');
        $a_data['input'][] = array('key' => 'idkabupaten', 'label' => 'Kabupaten', 'type' => 'S', 'option' => $kabupaten, 'hidden' => true, 'readonly' => false, 'add' => 'onchange="changekecamatan(this)"');
        $a_data['input'][] = array('key' => 'idkecamatan', 'label' => 'Kecamatan', 'type' => 'S', 'option' => $kecamatan, 'hidden' => true, 'readonly' => false, 'add' => 'onchange="changedesa(this)"');
        $a_data['input'][] = array('key' => 'iddesa', 'label' => 'Desa', 'type' => 'S', 'option' => $desa, 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'akses';
        $a_data['label'] = 'Hak Akses';
        $a_data['p_key'] = 'idakses';

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

?>