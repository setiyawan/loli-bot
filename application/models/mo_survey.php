<?php

require_once APPPATH.'/models/m_model.php';

class Mo_survey extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ke_survey2');
        define('header', 'Survey');
        define('order', 'idsurvey');
    }

    public function add($data)
 	{
 		$variabel = array();
 		$variabel['jeniskelamin'] 		= 2;
 		$variabel['umur'] 				= 3;
 		$variabel['pendidikan'] 		= 4;
 		$variabel['pekerjaan']			= 5;
 		$variabel['jmlhindividu'] 		= 6;
 		$variabel['penguasaanbangunan'] = 8;
 		$variabel['jenisatap'] 			= 9;
 		$variabel['jenisdinding']		= 10;
 		$variabel['jenislantai'] 		= 11;
 		$variabel['airminum']			= 12;
 		$variabel['penerangan'] 		= 13;
 		$variabel['bahanbakarmasak'] 	= 14;
 		$variabel['fasilitasbab'] 		= 15;
 		$variabel['pembuangantinja'] 	= 16;

 		$umur[0] = 15;
 		$umur[1] = 64;


 		foreach ($data as $key => $value) {
 			if(!empty($variabel[$key])) {
 				$query = $this->db->get_where('ta.ms_variabel', array('idvariabel' => $variabel[$key]));
 				$bobot = $query->row()->bobot;
 				$parent = $query->row()->idparent;
 				//perubahan value
 				if($key == 'umur') {
 					if($value > $umur[1]) $value = $value/$umur[1];
 					else if($value < $umur[0]) $value = $umur[0]/$value;
 					else $value = 1;
 				} else if($key == 'pendidikan') {
 					$value = 4 - $value;
 				} else if($key == 'pekerjaan') {
 					$q = $this->db->get_where('ta.ms_gaji', array('idgaji' => $value));
 					$value = $q->row()->nominal;
 					$value = ($data['jmlhindividu']/$value) * 1000000;
 				}

 				if(empty($hasil[$parent])) $hasil[$parent] = 0;
 				$hasil[$parent] += ($bobot * $value);
 			}
 		}
 		
 		foreach ($hasil as $key => $value) {
 			$query = $this->db->get_where('ta.ms_variabel', array('idvariabel' => $key));
 			$bobot = $query->row()->bobot;
 			if(empty($result)) $result = 0;
 			$result += ($bobot * $value);
 		}

 		$data['hasil'] = round($result, 3);
 		$result = $this->db->get_where(table, $data);
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

 	public function sync()
 	{
 		$variabel = array();
 		$variabel['jeniskelamin'] 		= 2;
 		$variabel['umur'] 				= 3;
 		$variabel['pendidikan'] 		= 4;
 		$variabel['pekerjaan']			= 5;
 		$variabel['jmlhindividu'] 		= 6;
 		$variabel['penguasaanbangunan'] = 8;
 		$variabel['jenisatap'] 			= 9;
 		$variabel['jenisdinding']		= 10;
 		$variabel['jenislantai'] 		= 11;
 		$variabel['airminum']			= 12;
 		$variabel['penerangan'] 		= 13;
 		$variabel['bahanbakarmasak'] 	= 14;
 		$variabel['fasilitasbab'] 		= 15;
 		$variabel['pembuangantinja'] 	= 16;

 		$umur[0] = 15;
 		$umur[1] = 64;
 		$berhasil = 0;
 		$gagal = 0;
 		$this->db->order_by("idsurvey", "asc");
 		$query = $this->db->get(table, 5000, 73000);
 		$a_data = $query->result_array();
 		foreach ($a_data as $keys => $data) {
 			foreach ($data as $key => $value) {
	 			if(!empty($variabel[$key])) {
	 				$query = $this->db->get_where('ta.ms_variabel', array('idvariabel' => $variabel[$key]));
	 				$bobot = $query->row()->bobot;
	 				$parent = $query->row()->idparent;
	 				//perubahan value
	 				if($key == 'umur') {
	 					if($value > $umur[1]) $value = $value/$umur[1];
	 					else if($value < $umur[0]) $value = $umur[0]/$value;
	 					else $value = 1;
	 				} else if($key == 'pendidikan') {
	 					$value = 4 - $value;
	 				} else if($key == 'pekerjaan') {
	 					$query = $this->db->get_where('ta.ms_gaji', array('idgaji' => $value));
	 					$value = $query->row()->nominal;
	 					if($value != 0)
	 						$value = ($data['jmlhindividu']/$value) * 1000000;
	 				}

	 				if(empty($hasil[$parent])) $hasil[$parent] = 0;
	 				$hasil[$parent] += ($bobot * $value);
	 			}
	 		}

	 		$result = 0;
	 		foreach ($hasil as $key => $value) {
	 			$query = $this->db->get_where('ta.ms_variabel', array('idvariabel' => $key));
	 			$bobot = $query->row()->bobot;
	 			$result += ($bobot * $value);
	 		}

	 		$data['hasil'] = round($result, 3);
	 		unset($result);
	 		unset($hasil);
	 		
	 		$sync['idsurvey'] = $data['idsurvey'];
	 		$sync['hasil'] = $data['hasil'];

	 		$this->db->where(key, $data[key]);
			$results = $this->db->update(table, $sync);
			if($results) 
			{
	    		$data = array(
					'code' => "212",
					'message' => header . " Berhasil Diperbarui Sebanyak " . ++$berhasil . " Data",
					'data' => $data
					);
	    	}
	    	else
	    	{
	    		$data = array(
					'code' => "515",
					'message' => header . " Gagal Diperbarui Sebanyak " . ++$gagal . " Data",
					'data' => null
					); 
	    	}
 		}
 		return $data;
 	}

 	// public function getall($start = 0){
 	// 	$jabatan = $this->session->userdata('jabatan');
  //       $idakun = $this->session->userdata('idakun');
  //       if($jabatan != 'admin') $this->db->where('idakun', $idakun);
        
  //       $this->db->select('idsurvey, idkeluarga, tglsurvey');
 	//  	$this->db->order_by(order, 'asc');
 	// 	$result = $this->db->get(table, 1000, $start);
 	// 	if($result->num_rows() > 0) 
		// {
  //   		$data = array(
		// 		'code' => "212",
		// 		'message' => "Daftar " . header,
		// 		'data' => $result->result_array()
		// 		); 
  //   	}
  //   	else
  //   	{
  //   		$data = array(
		// 		'code' => "515",
		// 		'message' => header . " Tidak Ditemukan",
		// 		'data' => null
		// 		); 
  //   	}
  //   	return $data;
 	// }

 	public function getall($idakun = 0)
 	{
 		$result = $this->db->query("select idsurvey, idkeluarga, nama, tglsurvey, alamat, namadesa, namakecamatan, namakabupaten, namaprovinsi from ta.v_survey3 s
		join ta.ke_akses a on a.iddesa = s.iddesa and s.idkecamatan = a.idkecamatan
		where a.idakun = $idakun"); 
 		
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