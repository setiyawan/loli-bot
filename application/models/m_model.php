<?php

class M_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

    public function nextval() {
    	$this->db->select_max(key);
    	$query = $this->db->get(table)->result_array();
    	$data = ($query[0][key] + 1);
    	return $data;
    }

    public function datacount()
    {
    	$data = $this->db->count_all_results(table);
    	return $data;
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
        if($jabatan == 'validator' || $jabatan == 'surveyor') $this->db->where('idakun', $idakun);
        
 	 	$this->db->order_by(order, 'asc');
 		$result = $this->db->get(table, 1000, $start);
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
 		$query = $this->db->get_where(table, array(key => $id));
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

 	public function delete($id)
	{
		$query = $this->db->get_where(table, array(key => $id));
		if($query->num_rows() > 0)
		{
			$this->db->delete(table, array(key => $id));
			$data = array(
				'code' => "212",
				'message' => header . " Berhasil Dihapus",
				'data' => null
				);
		}
		else
		{
			$data = array(
				'code' => "515",
				'message' => header . " Gagal Dihapus",
				'data' => null
				);
		}
		return $data;
	}

	public function member($id){
 		$query = $this->db->get_where(table, array(parentkey => $id));
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

 	public function reduce($data){
 		$tmp = array();

 		$table = explode(".", table);
 		$this->db->select('column_name');
 		$query = $this->db->get_where('information_schema.columns', array('table_name'=> $table[1]));
 		foreach($query->result_array() as $key) {
 			$tmp[$key['column_name']] = true;
 		}
 		foreach ($data as $key => $value) {
 			if(empty($tmp[$key])) unset($data[$key]);
 		}
 		
		return $data;
 	}	

}

?>