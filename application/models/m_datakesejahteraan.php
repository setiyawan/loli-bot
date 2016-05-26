<?php

require_once APPPATH.'/models/m_model.php';

class M_datakesejahteraan extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ke_survey2');
        define('header', 'Survey');
        define('order', 'idsurvey');
    }

    public function getall($start = 0, $filter = false){
 		$jabatan = $this->session->userdata('jabatan');
        $idakun = $this->session->userdata('idakun');
        if($jabatan != 'admin') {
        	$where = "idvalidator=$idakun OR idvalidator is null";
        	$this->db->where($where);
        }
        if(!empty($filter)) $this->db->where($filter);
 	 	$this->db->order_by(order, 'asc');
 		$result = $this->db->get('ta.v_survey2', 1000, $start);
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

 	public function cetak($start = 0, $filter = false){
 		$jabatan = $this->session->userdata('jabatan');
        $idakun = $this->session->userdata('idakun');
        if($jabatan != 'admin') {
        	$where = "idvalidator=$idakun OR idvalidator is null";
        	$this->db->where($where);
        }
        if(!empty($filter)) $this->db->where($filter);
 	 	$this->db->order_by(order, 'asc');
 		$result = $this->db->get('ta.v_survey3');
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
}

?>