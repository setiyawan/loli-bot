<?php

require_once APPPATH.'/models/m_model.php';

class M_user extends M_Model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ms_akun');
        define('header', 'Akun');
        define('order', 'user_id');
    }

	public function login($username, $password)
 	{
		$this->db->select('*');
		$query = $this->db->get_where('ms_akun', array(
		'username' => $username, 
		'password' => md5($password)
		));
		if ($query->num_rows() > 0){	            
	            foreach ($query->result() as $row) {
	                if($row->status == 1){
	                	$result['code'] = "200";
		            	$result['message'] = "Selamat, anda berhasil login";
		                $result['data'] = $query->result_array();

						$this->db->where('username', $username);
	                }
	                else if($row->status != 1){
	                	$result['code'] = "402";
			        	$result['message'] = "Akun anda belum diaktifkan, hubungi admin untuk aktivasi akun";
			        	$result['data'] = null;
	                }
	                else {
	                	$result['code'] = "403";
			        	$result['message'] = "Akun anda tidak mempunyai hak akses";
			        	$result['data'] = null;
	                }
	            }
            
	        }
	        else{
	        	$result['code'] = "403";
	        	$result['message'] = "Username atau password tidak ditemukan";
	        	$result['data'] = null;	
	        }
	        return $result;
 	}

 	public function c_login($username, $password)
 	{
		$this->db->select('*');
		$query = $this->db->get_where('ms_akun', array(
		'username' => $username, 
		'password' => md5($password)
		));
		if ($query->num_rows() > 0){	            
	            foreach ($query->result() as $row) {
	                if($row->status == 1 && ($row->jabatan == 'surveyor') ){
	                	$result['code'] = "200";
		            	$result['message'] = "Selamat, anda berhasil login";
		                $result['data'] = $query->row();
	                }
	                else if($row->status != 1){
	                	$result['code'] = "402";
			        	$result['message'] = "Akun anda belum diaktifkan, hubungi admin untuk aktivasi akun";
			        	$result['data'] = null;
	                }
	                else {
	                	$result['code'] = "403";
			        	$result['message'] = "Akun anda tidak mempunyai hak akses";
			        	$result['data'] = null;
	                }
	            }
            
	        }
	        else{
	        	$result['code'] = "403";
	        	$result['message'] = "Username atau password tidak ditemukan";
	        	$result['data'] = null;	
	        }
	        return $result;
 	}

 	public function add($data)
 	{
 		//upload config 
		$config['upload_path'] 		= './images/user';
		$config['allowed_types'] 	= '*';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

	    if(!$this->upload->do_upload('file')){
	        $up_data		    = $this->upload->display_errors();
	    }else{
	        $up_data		    = $this->upload->data();
	        $data['file']		= $up_data['file_name'];
	    }
	    
 		$data['password'] = md5($data['username']);
 		$result = $this->db->get_where('public.ms_akun', array('username' => $data['username']));
		if ($result->num_rows() > 0){
			$data = array(
				'code' => "403",
				'message' => "Username telah terpakai, silahkan mendaftar dengan username lain",
				'data' => null
				);
		}
		else{
			$this->db->insert('public.ms_akun', $data); 
			$data = array(
				'code' => "200",
				'message' => "Selamat, registrasi berhasil. Silakan tunggu konfirmasi dari admin. Terima kasih",
				'data' => $data
				);			
		}
		return $data;
 	}

 	public function detail($user_id){
 		$query = $this->db->get_where('ms_akun', array('user_id' => $user_id));
		if ($query->num_rows() > 0){
			$result['code'] = "200";
        	        $result['message'] = "Daftar User";
                        $row = $query->result_array();
                        unset($row[0]['password']);
                        $result['data'] = $row;
                                   
                }
                else{
        	        $result['code'] = "402";
        	        $result['message'] = "User tidak ditemukan";
        	        $result['data'] = null;	
                }
                return $result;
 	}	

    public function delete($user_id)
	{
		$result = $this->db->get_where('ms_akun', array('user_id' => $user_id));
		if($result->num_rows() > 0)
		{
			$this->db->delete('public.ms_akun', array('user_id' => $user_id));
			$data = array(
				'code' => "200",
				'message' => "Data Berhasil Dihapus",
				'data' => null
				);
		}
		else
		{
			$data = array(
				'code' => "403",
				'message' => "Data Gagal Dihapus. Data Tidak Ditemukan atau Masih Dijadikan Referensi",
				'data' => null
				);
		}
		return $data;
	}

    public function update($data)
	{
		$this->db->trans_begin();

		//upload config 
		$config['upload_path'] 		= './images/user';
		$config['allowed_types'] 	= '*';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

	    if(!$this->upload->do_upload('file')){
	        $up_data		    = $this->upload->display_errors();
	    }else{
	        $up_data		    = $this->upload->data();
	        $data['file']		= $up_data['file_name'];
	    }

		$this->db->where('user_id', $data['user_id']);
		$result = $this->db->update('public.ms_akun', $data);
		if($result) 
		{
    		$data = array(
				'code' => "200",
				'message' => "Akun Berhasil Diperbarui ",
				'data' => $data
				); 
    		$this->db->trans_commit();
    	}
    	else
    	{
    		$data = array(
				'code' => "403",
				'message' => "Akun Gagal Diperbarui",
				'data' => null
				); 
    		$this->db->trans_rollback();
    	}

		return $data;
	}

	public function updatePassword($data)
	{
		$this->db->select('password');
		$passwordLama = $this->db->get_where('public.ms_akun', array('user_id' => $data['user_id']))->row();
		$passwordLama = $passwordLama->password;

		$password = md5($data['password']);
		$password1 = md5($data['password1']);
		$password2 = md5($data['password2']);

		if($password == $passwordLama && $password1 == $password2 && !empty($data['user_id'])) 
		{
			$this->db->where('user_id', $data['user_id']);
			$this->db->update('public.ms_akun', array('password' => $password1));
    		$data = array(
				'code' => "200",
				'message' => "Password Berhasil Diperbarui",
				'data' => $data
				); 
    	}
    	else
    	{
    		$data = array(
				'code' => "403",
				'message' => "Password Gagal Diperbarui",
				'data' => null
				); 
    	}

		return $data;
	}

	
}

/* End of file akun.php */