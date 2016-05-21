<?php

require_once APPPATH.'/models/m_model.php';

class M_desa extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ms_desa');
        define('header', 'Desa');
        define('order', 'idkecamatan, iddesa');
    }

    public function detail($id){
 		$query = $this->db->get_where('ta.v_daerah', array(key => $id));
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
}

?>