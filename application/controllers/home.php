<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Home extends C_controller
{
    public function __construct()
    {
        parent::__construct();
        define('model', 'm_dashboard');
        //define('key', 'idkabupaten');
        //define('parentkey', 'idprovinsi');
        $this->is_logged();
    }

    public function index()
    {
        $this->load->model(model);
        $a_data = $this->{model}->datacount();
        $a_data['tabelkecamatan'] = $this->{model}->tabelkecamatan();
    	$this->load->view('header');
    	$this->load->view('home', $a_data);
    	$this->load->view('footer');
    }

    public function data()
    {
        $this->load->model(model);
        $a_data = $this->{model}->chart();
        echo json_encode($a_data);
    }

    public function grafik()
    {
        $this->load->model(model);
        $a_data = $this->{model}->grafik();
        echo json_encode($a_data);
    }

    public function hampirmiskin()
    {
        $this->load->model(model);
        $a_data = $this->{model}->hampirmiskin();
        echo json_encode($a_data);
    }

    public function miskin()
    {
        $this->load->model(model);
        $a_data = $this->{model}->miskin();
        echo json_encode($a_data);
    }

    public function sangatmiskin()
    {
        $this->load->model(model);
        $a_data = $this->{model}->sangatmiskin();
        echo json_encode($a_data);
    }
}

?>