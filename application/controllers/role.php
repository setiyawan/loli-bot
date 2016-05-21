<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Role extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_role');
        define('key', 'idrole');
        $this->is_logged();
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $page = $this->m_combo->page();
        $akun = $this->m_combo->akun2();
        $jabatan = $this->m_combo->jabatan();
        $auth = $this->m_combo->auth();

        $a_data['input'][] = array('key' => 'idrole', 'label' => 'Id Page', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'idpage', 'label' => 'Nama Halaman', 'type' => 'S', 'option' => $page, 'hidden' => false, 'readonly' => false);
        // $a_data['input'][] = array('key' => 'idakun', 'label' => 'Nama User', 'type' => 'S', 'option' => $akun, 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'jabatan', 'label' => 'Jenis Jabatan', 'type' => 'S', 'option' => $jabatan, 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'c_insert', 'label' => 'Insert', 'type' => 'S', 'option' => $auth, 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'c_edit', 'label' => 'Edit', 'type' => 'S', 'option' => $auth, 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'c_delete', 'label' => 'Delete', 'type' => 'S', 'option' => $auth, 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'role';
        $a_data['label'] = 'Daftar Hak Akses Halaman';
        $a_data['p_key'] = 'idrole';

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