<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class C_pekerjaan extends C_controller
{
    public function __construct()
    {
        parent::__construct();
        define('model', 'm_gaji');
        define('key', 'idgaji');
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
        // $this->load->model('m_auth');
        // $a_auth = $this->m_auth->role();

        // $a_data['c_insert'] = $a_auth['c_insert'];
        // $a_data['c_edit'] = $a_auth['c_edit'];
        // $a_data['c_delete'] = $a_auth['c_delete'];
        
        return array_merge($data, $a_data);
    }

    public function input($a_data)
    {
        // $a_data = $this->data($a_data);
        echo json_encode($a_data);
    }

    public function getall($data='')
    {
        $a_filter = array();
        $reqpage = 0;
        $page = $this->input->post('page');
        $valid = $this->input->post('valid');

        if($valid == null) $valid = -1;
        if($valid != -1) $a_filter['isvalid'] = $valid;
        
        if(!empty($page)) $reqpage = $page * 1000;
        
        $this->load->model(model);
        $a_data = $this->{model}->getall($reqpage, $a_filter);
        $a_data['datacount'] = ceil($this->{model}->datacount()/1000);
        
        if(!empty($data)) {
            $a_data['message'] = $data['message'];
            $a_data['code'] = $data['code'];
        }
        else
            $a_data['message'] = "";
        
        $a_data['page'] = $reqpage/1000;
        $a_data['valid'] = $valid;
        $this->input($a_data);
        //json_encode($a_data);
    }
}