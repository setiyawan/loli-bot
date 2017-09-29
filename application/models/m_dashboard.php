<?php

require_once APPPATH.'/models/m_model.php';

class M_dashboard extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table1', 'public.ms_daerah');
        define('table2', 'public.ms_wisata');
        define('table3', 'public.ms_detail_wisata');
    }

    public function datacount()
    {
        $this->db->where('status', 1);
        $this->db->from(table1);
    	$data['total_daerah'] = $this->db->count_all_results();

        $this->db->where('status', 1);
        $this->db->where('jenis_wisata', '1');
        $this->db->from(table2);
    	$data['wisata_kuliner'] = $this->db->count_all_results();

    	$this->db->where('status', 1);
        $this->db->where('jenis_wisata', '2');
		$this->db->from(table2);
		$data['wisata_alam'] = $this->db->count_all_results();

		$this->db->where('status', 1);
		$this->db->from(table2);
		$data['jumlah_produk'] = $this->db->count_all_results();
    	return $data;
    }

}

?>