<?php

require_once APPPATH.'/models/m_model.php';

class M_daerah extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ms_daerah');
        define('header', 'Daerah');
        define('order', 'points');
    }

    public function topList($count = 0)
 	{        
 	 	$this->db->order_by(order, 'asc');
 		$result = $this->db->get(table, $count);
 		if($result->num_rows() > 0) 
		{
    		$data = array(
				'code' => "200",
				'message' => "Daftar Top List City",
				'data' => $result->result_array()
				); 
    	}
    	else
    	{
    		$data = array(
				'code' => "404",
				'message' => "Top List City Tidak Ditemukan",
				'data' => null
				); 
    	}
    	return $data;
 	}
}

?>