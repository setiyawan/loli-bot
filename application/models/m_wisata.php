<?php

require_once APPPATH.'/models/m_model.php';

class M_wisata extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ms_wisata');
        define('header', 'Wisata');
        define('order', 'id_wisata');
    }

    public function details($filter)
 	{
 		$query = $this->db->get_where(table, $filter);
		if ($query->num_rows() > 0){
			$result['code'] = "200";
        	        $result['message'] = "Detail " . header;
                    $row = $query->result_array();
                    $result['data'] = $row[0];
                }
                else{
        	        $result['code'] = "404";
        	        $result['message'] = header . " Tidak Ditemukan";
        	        $result['data'] = null;	
                }
                return $result;
 	}
}

?>