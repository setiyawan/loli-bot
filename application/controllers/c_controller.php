<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function is_logged()
    {
        $user = $this->session->userdata['is_logged_in'];
        if(empty($user)) 
        {
            $this->load->helper('url');
            redirect('index.php/user/login');
        }
        else
        return isset($user);
    }

	public function add()
    {
        $this->is_logged();
        $data = $this->input->post();
        $this->load->model(model);
        $data[key] = $this->{model}->nextval();
        $data = $this->{model}->reduce($data);
        $a_data = $this->{model}->add($data);
        $this->getall($a_data);
    }

    public function update()
    {
        $this->is_logged();
        $data = $this->input->post();
        $this->load->model(model);
        $data = $this->{model}->reduce($data);
        $a_data = $this->{model}->update($data);
        $this->getall($a_data);
    }

    public function getall($data='')
    {
        $reqpage = 0;
        $page = $this->input->post('page');
        if(!empty($page)) $reqpage = $page * 1000;
        $this->is_logged();
        $this->load->model(model);
        $a_data = $this->{model}->getall($reqpage);
        $a_data['datacount'] = ceil($this->{model}->datacount()/1000);
        
        if(!empty($data)) {
            $a_data['message'] = $data['message'];
            $a_data['code'] = $data['code'];
        }
        else
            $a_data['message'] = "";
        
        $a_data['page'] = $reqpage/1000;
        $this->input($a_data);
        json_encode($a_data);
    }

    public function delete()
    {
        $this->is_logged();
        $id = $this->input->post("id_delete");
        $this->load->model(model);
        $a_data = $this->{model}->delete($id);
        $this->getall($a_data);
    }

    public function detail($id)
    {
        $this->is_logged();
        $this->load->model(model);
        $a_data = $this->{model}->detail($id);
        echo json_encode($a_data);
    }

    public function member($id)
    {
        $this->is_logged();
        $this->load->model(model);
        $a_data = $this->{model}->member($id);
        echo json_encode($a_data);
    }
}

?>