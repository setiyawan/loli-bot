<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Variabel extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_variabel');
        define('key', 'idvariabel');
        $this->is_logged();
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $variabel = $this->m_combo->variabel(true);

        $a_data['input'][] = array('key' => 'idvariabel', 'label' => 'Id Variabel', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'idparent', 'label' => 'Parent', 'type' => 'S', 'option' => $variabel, 'hidden' => false, 'readonly' => true);
        //$a_data['input'][] = array('key' => 'tingkat', 'label' => 'Tingkat', 'type' => 'T', 'hidden' => true, 'readonly' => true);
        $a_data['input'][] = array('key' => 'namavariabel', 'label' => 'Nama Variabel', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'bobot', 'label' => 'Bobot', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'variabel';
        $a_data['label'] = 'Data Variabel';
        $a_data['p_key'] = 'idvariabel';

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