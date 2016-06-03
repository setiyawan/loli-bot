<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class User extends C_controller
{
    public function __construct()
    {
        parent::__construct();
        define('model', 'm_user');
        define('key', 'idakun');
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $aktif = $this->m_combo->aktif();
        $jeniskelamin = $this->m_combo->jeniskelamin();
        $jabatan = $this->m_combo->jabatan();

        $a_data['input'][] = array('key' => 'idakun', 'label' => 'Id Akun', 'type' => 'T', 'hidden' => true, 'readonly' => true);
        $a_data['input'][] = array('key' => 'nama', 'label' => 'Nama', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'tgllahir', 'label' => 'Tgl Lahir','type' => 'D', 'hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'alamat', 'label' => 'Alamat', 'type' => 'T', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'jeniskelamin', 'label' => 'Jenis Kelamin', 'type' => 'S', 'hidden' => true, 'option' => $jeniskelamin, 'readonly' => false);
        $a_data['input'][] = array('key' => 'nohp', 'label' => 'No. HP', 'type' => 'N', 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'jabatan', 'label' => 'Jabatan', 'type' => 'S', 'option' => $jabatan, 'hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'status', 'label' => 'Status', 'type' => 'S','hidden' => false, 'option' => $aktif, 'readonly' => false);
        //$a_data['input'][] = array('key' => 'tingkat', 'label' => 'Tingkat', 'type' => 'T','hidden' => false, 'readonly' => false);
        $a_data['input'][] = array('key' => 'noidentitas', 'label' => 'Identitas', 'type' => 'T','hidden' => true, 'readonly' => false);
        $a_data['input'][] = array('key' => 'username', 'label' => 'Username', 'type' => 'T','hidden' => true, 'readonly' => true);
        $a_data['input'][] = array('key' => 'file', 'label' => 'Foto', 'type' => 'F','hidden' => true, 'readonly' => false);

        $a_data['script'] = 'user';
        $a_data['label'] = 'Daftar Akun';
        $a_data['p_key'] = 'idakun';

        //variabel request
        $this->load->model('m_auth');
        $a_auth = $this->m_auth->role();

        $a_data['c_insert'] = $a_auth['c_insert'];
        $a_data['c_edit'] = $a_auth['c_edit'];
        $a_data['c_delete'] = $a_auth['c_delete'];
        
        return array_merge($data, $a_data);
    }

    public function login()
    {
    	$username = $this->input->post('username');
    	$password = $this->input->post('password');
        $this->load->model('m_user');
		$a_data = $this->m_user->login($username, $password);

        if($a_data['code'] == '212'){
            $this->session->set_userdata('is_logged_in', $username);

            //session
            foreach ($a_data['data'][0] as $key => $value) {
                $this->session->set_userdata($key, $value);
            }
            
            if ($this->is_logged())
            {
                redirect('index.php/home', 'refresh');
            }
        } else
            {
                $this->load->view('header');
                $this->load->view('login', $a_data);
                $this->load->view('footer');
            }
    }

    public function register()
    {
    	$data = $this->input->post();
        $this->load->model('m_user');
		$a_data = $this->m_user->register($data);
		echo json_encode($a_data);
    }

    public function update()
    {
        $this->is_logged();
    	$data = $this->input->post();
        if(empty($data['foto'])) unset($data['foto']);
        $this->load->model('m_user');
		$a_data = $this->m_user->update($data);
        $this->getall($a_data);
    }

    public function getall($data='')
    {
        $this->is_logged();
        $this->db->where('idakun<>', 0);
        $this->load->model('m_user');
		$a_data = $this->m_user->getall();
        $a_data = $this->data($a_data);
        
        if(!empty($data)) {
            $a_data['message'] = $data['message'];
            $a_data['code'] = $data['code'];  
        }

        $this->load->view('header');
        $this->load->view('inc_data-01', $a_data);
        $this->load->view('footer');
    }
/*
    public function delete()
    {
        $this->is_logged();
    	$username = $this->input->post('username');
        $this->load->model('m_user');
		$a_data = $this->m_user->delete($username);
		echo json_encode($a_data);
    }
*/
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_userdata('is_logged_in', false);
        $this->load->view('header');
        $this->load->view('login');
        $this->load->view('footer');
    }

    public function detail($idakun)
    {
        $this->load->model('m_user');
        $a_data = $this->m_user->detail($idakun);
        echo json_encode($a_data);
        //$a_data = $this->data($a_data);
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
            echo "<script>alert('Password Berhasil Diperbarui');</script>";
        } else
            echo "<script>alert('Password Gagal Diperbarui');</script>";
        
        redirect('index.php/home', 'refresh');
    }

}

?>