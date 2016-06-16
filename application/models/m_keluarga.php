<?php

require_once APPPATH.'/models/m_model.php';

class M_keluarga extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ms_keluarga');
        define('header', 'Keluarga');
        define('order', 'idkeluarga');
    }

    public function add($data)
 	{
 		$result = $this->db->get_where(table, array(key => $data[key]));
		if ($result->num_rows() > 0){
			$data = array(
				'code' => "515",
				'message' => header . " Sudah Ditambahkan Sebelumnya",
				'data' => null
				);
		}
		else{
			$this->db->insert(table, $data); 
			$data = array(
				'code' => "212",
				'message' => header . " Berhasil ditambahkan",
				'data' => $data
				);			
		}
		return $data;
 	}

 	function update($data)
 	{
 		$this->db->where(key, $data[key]);
		$result = $this->db->update(table, $data);
		if($result) 
		{
    		$data = array(
				'code' => "212",
				'message' => header . " Berhasil Diperbarui",
				'data' => $data
				); 
    	}
    	else
    	{
    		$data = array(
				'code' => "515",
				'message' => header . " Gagal Diperbarui",
				'data' => null
				); 
    	}
    	return $data;
 	}

    public function getall($start = 0){
 		$jabatan = $this->session->userdata('jabatan');
        $idakun = $this->session->userdata('idakun');
        if($jabatan != 'admin') $this->db->where('idakun', $idakun);
        
 	 	$this->db->order_by(order, 'asc');
 		$result = $this->db->get('ta.v_keluarga', 1000, $start);
 		if($result->num_rows() > 0) 
		{
    		$data = array(
				'code' => "212",
				'message' => "Daftar " . header,
				'data' => $result->result_array()
				); 
    	}
    	else
    	{
    		$data = array(
				'code' => "515",
				'message' => header . " Tidak Ditemukan",
				'data' => null
				); 
    	}
    	return $data;
 	}

 	public function detail($id){
 		$query = $this->db->get_where('ta.v_keluarga', array(key => $id));
		if ($query->num_rows() > 0){
			$result['code'] = "212";
	        $result['message'] = "Detail " . header;
                $row = $query->result_array();
                $result['data'] = $row;
                           
        }
        else{
	        $result['code'] = "515";
	        $result['message'] = header . " Tidak Ditemukan";
	        $result['data'] = null;	
        }
        return $result;
 	}

 	public function listSurvey($id) {
 		$query = $this->db->query("select idkeluarga, nama, alamat from ta.v_keluarga s
			join ta.ke_akses a on a.iddesa = s.iddesa and s.idkecamatan = a.idkecamatan
			where a.idakun = $id and s.idkeluarga not in
			(
			select idkeluarga from ta.v_survey3 s
			join ta.ke_akses a on a.iddesa = s.iddesa and s.idkecamatan = a.idkecamatan
			where a.idakun = $id
			)
			order by alamat, nama asc");
 		if (count($query->result() > 0)){
			$result['code'] = "212";
	        $result['message'] = "Detail " . header;
                $row = $query->result_array();
                $result['data'] = $row;
                           
        }
        else{
	        $result['code'] = "515";
	        $result['message'] = header . " Tidak Ditemukan";
	        $result['data'] = null;	
        }
        return $result;
 	}
}

?>