<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class C_survey extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'mo_survey');
        define('key', 'idsurvey');
        //$this->is_logged();
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
        return array_merge($data, $a_data);
    }

    public function input($a_data)
    {
        //$a_data = $this->data($a_data);

        echo json_encode($a_data);
    }

    // public function getall($data='')
    // {
    //     $a_filter = array();
    //     $reqpage = 0;
    //     $page = $this->input->post('page');
    //     $valid = $this->input->post('valid');

    //     if($valid == null) $valid = -1;
    //     if($valid != -1) $a_filter['isvalid'] = $valid;
        
    //     if(!empty($page)) $reqpage = $page * 1000;
        
    //     $this->load->model(model);
    //     $a_data = $this->{model}->getall($reqpage, $a_filter);
    //     $a_data['datacount'] = ceil($this->{model}->datacount()/1000);
        
    //     if(!empty($data)) {
    //         $a_data['message'] = $data['message'];
    //         $a_data['code'] = $data['code'];
    //     }
    //     else
    //         $a_data['message'] = "";
        
    //     $a_data['page'] = $reqpage/1000;
    //     $a_data['valid'] = $valid;
    //     $this->input($a_data);
    //     //json_encode($a_data);
    // }

    public function getall($data='')
    {
        $a_filter = array();
        $reqpage = 0;
        $idakun = $this->input->post('idakun');
        $page = $this->input->post('page');
        $valid = $this->input->post('valid');

        if($valid == null) $valid = -1;
        if($valid != -1) $a_filter['isvalid'] = $valid;
        
        if(!empty($page)) $reqpage = $page * 1000;
        
        $this->load->model(model);
        $a_data = $this->{model}->getall($idakun);
        $a_data['datacount'] = ceil($this->{model}->datacount()/1000);
        
        $a_data['page'] = $reqpage/1000;
        $a_data['valid'] = $valid;
        $this->input($a_data);
        //json_encode($a_data);
    }
}