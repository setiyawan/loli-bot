<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class C_keluarga extends C_controller
{
    public function __construct()
    {
        parent::__construct();
        define('model', 'm_keluarga');
        define('key', 'idkeluarga');
    }

    public function data($data)
    {
        $a_data['input'][] = array('key' => 'idgaji', 'label' => 'Kode', 'type' => 'T', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'sektorpekerjaan', 'label' => 'Pekerjaan', 'type' => 'T', 'hidden' => false, 'readonly' => true);
        $a_data['input'][] = array('key' => 'nominal', 'label' => 'Nominal', 'type' => 'N', 'hidden' => false, 'readonly' => false);
        $a_data['script'] = 'gaji';
        $a_data['label'] = 'Data Gaji';
        $a_data['p_key'] = 'idgaji';        
        
        return array_merge($data, $a_data);
    }

    public function input($a_data)
    {
        echo json_encode($a_data);
    }

    public function listSurvey($data='')
    {
        $this->load->model(model);
        $a_data = $this->{model}->listSurvey(4);
        echo json_encode($a_data);
    }
}