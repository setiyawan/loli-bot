<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_wisata extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_wisata');
    }

    public function index()
    {
        $this->load->model(model);
        $a_data = $this->{model}->getall();
        echo json_encode($a_data);
    }

    public function detail()
    {
        $filter = $this->input->get();
        $this->load->model(model);
        $a_data = $this->{model}->details($filter);
        echo json_encode($a_data);
    }
}