<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_user extends CI_Controller
{
    public function login()
    {
    	$username = $this->input->post('username');
    	$password = $this->input->post('password');
        $this->load->model('m_user');
		$a_data = $this->m_user->c_login($username, $password);
		echo json_encode($a_data);
    }

    public function update()
    {
    	$data = $this->input->post();
        $this->load->model('m_user');
		$a_data = $this->m_user->update($data);
		echo json_encode($a_data);
    }

    public function getall()
    {
        $this->load->model('m_user');
		$a_data = $this->m_user->getall();
		echo json_encode($a_data);
    }

    public function delete()
    {
    	$username = $this->input->post('username');
        $this->load->model('m_user');
		$a_data = $this->m_user->delete($username);
		echo json_encode($a_data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_userdata('is_logged_in', false);
    }

    public function detail($idakun)
    {
        $this->load->model('m_user');
        $a_data = $this->m_user->detail($idakun);
        echo json_encode($a_data);
    }

    public function changePassword()
    {
        $this->is_logged();
        $data['idakun'] = $this->session->userdata('idakun');
        $pass = $this->session->userdata('password');
        $pass0 = md5($this->input->post('password'));
        $pass1 = md5($this->input->post('password1'));
        $pass2 = md5($this->input->post('password2'));
        if($pass == $pass0 && $pass1 == $pass2) 
        {
            $data['password'] = $pass1;
            $this->load->model('m_user');
            $a_data = $this->m_user->update($data);
        }
        echo json_encode($a_data);
    }

}

?>