<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Kesejahteraan extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_kesejahteraan');
        define('key', 'idkesejahteraan');
        define('parentkey', 'idprovinsi');
        $this->is_logged();
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $provinsi = $this->m_combo->provinsi();

        $a_data['input'][] = array('key' => 'idkesejahteraan', 'label' => 'Id Kabupaten', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'nama', 'label' => 'Kategori', 'type' => 'T', 'hidden' => false, 'readonly' => true);
        $a_data['input'][] = array('key' => 'tk_kemiskinan', 'label' => 'Tingkat Kemiskinan', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'batasbawah', 'label' => 'Batas Bawah', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'batasatas', 'label' => 'Batas Atas', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'kesejahteraan';
        $a_data['label'] = 'Tingkat Kesejahteraan';
        $a_data['p_key'] = 'idkesejahteraan';

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