<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Daerah extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_daerah');
        define('key', 'id_daerah');
        $this->is_logged();
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $aktif = $this->m_combo->aktif();

        $a_data['input'][] = array('key' => 'id_daerah', 'label' => 'Id', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'provinsi', 'label' => 'Provinsi', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'kota', 'label' => 'Kota', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'status', 'label' => 'Status', 'type' => 'S', 'option' => $aktif, 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'daerah';
        $a_data['label'] = 'Daftar Daerah';
        $a_data['p_key'] = 'id_daerah';

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