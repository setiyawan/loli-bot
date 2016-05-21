<?php

require_once APPPATH.'/models/m_model.php';

class M_user extends M_Model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ms_akun');
        define('header', 'Akun');
        define('order', 'idakun');
    }

	public function login($username, $password)
 	{
		$this->db->select('*');
		$query = $this->db->get_where('ta.ms_akun', array(
		'username' => $username, 
		'password' => md5($password)
		));
		if ($query->num_rows() > 0){	            
	            foreach ($query->result() as $row) {
	                if($row->status == 1 && ($row->jabatan == 'admin' || $row->jabatan == 'validator' || $row->jabatan == 'superadmin') ){
	                	$result['code'] = "212";
		            	$result['message'] = "Selamat, anda berhasil login";
		                $result['data'] = $query->result_array();

						$this->db->where('username', $username);
	                }
	                else if($row->status != 1){
	                	$result['code'] = "515";
			        	$result['message'] = "Akun anda belum diaktifkan, hubungi admin untuk aktivasi akun";
			        	$result['data'] = null;
	                }
	                else {
	                	$result['code'] = "515";
			        	$result['message'] = "Akun anda tidak mempunyai hak akses";
			        	$result['data'] = null;
	                }
	            }
            
	        }
	        else{
	        	$result['code'] = "515";
	        	$result['message'] = "Username atau password tidak ditemukan";
	        	$result['data'] = null;	
	        }
	        return $result;
 	}

 	public function c_login($username, $password)
 	{
		$this->db->select('*');
		$query = $this->db->get_where('ta.ms_akun', array(
		'username' => $username, 
		'password' => md5($password),
		'jabatan' => 'surveyor'
		));
		if ($query->num_rows() > 0){	            
	            foreach ($query->result() as $row) {
	                if($row->status == 1 && ($row->jabatan == 'surveyor') ){
	                	$result['code'] = "212";
		            	$result['message'] = "Selamat, anda berhasil login";
		                $result['data'] = $query->result_array();
	                }
	                else if($row->status != 1){
	                	$result['code'] = "515";
			        	$result['message'] = "Akun anda belum diaktifkan, hubungi admin untuk aktivasi akun";
			        	$result['data'] = null;
	                }
	                else {
	                	$result['code'] = "515";
			        	$result['message'] = "Akun anda tidak mempunyai hak akses";
			        	$result['data'] = null;
	                }
	            }
            
	        }
	        else{
	        	$result['code'] = "515";
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
 		$result = $this->db->get_where('ta.ms_akun', array('username' => $data['username']));
		if ($result->num_rows() > 0){
			$data = array(
				'code' => "515",
				'message' => "Username telah terpakai, silahkan mendaftar dengan username lain",
				'data' => null
				);
		}
		else{
			$this->db->insert('ta.ms_akun', $data); 
			$data = array(
				'code' => "212",
				'message' => "Selamat, registrasi berhasil. Silakan tunggu konfirmasi dari admin. Terima kasih",
				'data' => $data
				);			
		}
		return $data;
 	}

 	public function getall($start = 0){
 		$this->db->order_by(order, 'asc');
 		$query = $this->db->get('ta.ms_akun');

		if ($query->num_rows() > 0){
			$result['code'] = "212";
        	        $result['message'] = "";
                        $row = $query->result_array();
                        $result['data'] = $row;
                                   
                }
                else{
        	        $result['code'] = "515";
        	        $result['message'] = "User tidak ditemukan";
        	        $result['data'] = null;	
                }
                return $result;
 	}	

 	public function detail($idakun){
 		$query = $this->db->get_where('ta.ms_akun', array('idakun' => $idakun));
		if ($query->num_rows() > 0){
			$result['code'] = "212";
        	        $result['message'] = "Daftar User";
                        $row = $query->result_array();
                        unset($row[0]['password']);
                        $result['data'] = $row;
                                   
                }
                else{
        	        $result['code'] = "515";
        	        $result['message'] = "User tidak ditemukan";
        	        $result['data'] = null;	
                }
                return $result;
 	}	

    public function delete($idakun)
	{
		$result = $this->db->get_where('ta.ms_akun', array('idakun' => $idakun));
		if($result->num_rows() > 0)
		{
			$this->db->delete('ta.ms_akun', array('idakun' => $idakun));
			$data = array(
				'code' => "212",
				'message' => "Data Berhasil Dihapus",
				'data' => null
				);
		}
		else
		{
			$data = array(
				'code' => "515",
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

		$this->db->where('idakun', $data['idakun']);
		$result = $this->db->update('ta.ms_akun', $data);
		if($result) 
		{
    		$data = array(
				'code' => "212",
				'message' => "Akun Berhasil Diperbarui ",
				'data' => $data
				); 
    		$this->db->trans_commit();
    	}
    	else
    	{
    		$data = array(
				'code' => "515",
				'message' => "Akun Gagal Diperbarui",
				'data' => null
				); 
    		$this->db->trans_rollback();
    	}

		return $data;
	}

	
}

/* End of file akun.php */