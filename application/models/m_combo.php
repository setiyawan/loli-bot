<?php

class M_combo extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

    function page() {
        $this->db->order_by('idpage', 'asc');
        $query = $this->db->get('ta.sc_page')->result_array();
        foreach ($query as $key) {
            $data[$key['idpage']] = $key['page'];
        }
        return $data;
    }

    function auth() {
        $data = array('1' => 'True', '0' => 'False');
        return $data;
    }

    function variabel($empty = '') {
        $this->db->order_by('idvariabel', 'asc');
        $query = $this->db->get('ta.ms_variabel')->result_array();
        if($empty) $data[0] = '';
        foreach ($query as $key) {
            $data[$key['idvariabel']] = $key['namavariabel'];
        }
        return $data;
    }

    function gaji($empty = '') {
        $this->db->order_by('idgaji', 'asc');
        $query = $this->db->get('ta.ms_gaji')->result_array();
        //if($empty) $data[0] = '';
        foreach ($query as $key) {
            $data[$key['idgaji']] = $key['sektorpekerjaan'];
        }
        return $data;
    }

    function status($empty = false) {
        if($empty) 
            $data = array('-1' => 'Pilih Semua', '1' => 'Valid', '0' => 'Tidak Valid');
        else
    	   $data = array('1' => 'Valid', '0' => 'Tidak Valid');
    	return $data;
    }

    function aktif() {
        $data = array('1' => 'Aktif', '2' => 'Non Aktif');
        return $data;
    }

    function jabatan() {
        $data = array('admin' => 'Admin', 'surveyor' => 'Surveyor', 'validator' => 'Validator');
        return $data;
    }

    function jeniskelamin() {
    	$data = array('1' => 'Laki-laki', '2' => 'Perempuan');
    	return $data;
    }

    function pendidikan() {
    	$data = array('4' => 'Perguruan Tinggi', '3' => 'SMA/sederajat' , '2' => 'SMP/sederajat' , '1' => 'SD/sederajat', '0' => 'Tidak punya ijazah');
    	return $data;
    }

    function penguasaanbangunan() {
    	$data = array('1' => 'Milik sendiri', '2' => 'Kontrak/Sewa', '3' => 'Lainnya');
    	return $data;
    }

    function jenisatap() {
    	$data = array('1' => 'Beton', '2' => 'Genteng', '3' => 'Sirap', '4' => 'Seng', '5' => 'Asbes', '6' => 'Ijuk/Rumbai');
    	return $data;
    }
    
    function jenisdinding() {
    	$data = array('1' => 'Tembok', '2' => 'Kayu', '3' => 'Bambu', '4' => 'Lainnya');
    	return $data;
    }
    
    function jenislantai() {
    	$data = array('1' => 'Bukan Tanah/bambu', '2' => 'Tanah', '3' => 'Bambu');
    	return $data;
    }
    
    function airminum() {
    	$data = array('1' => 'Air Kemasan', '2' => 'Air Ledeng', '3' => 'Air Terlindung', '4' => 'Air Tidak Terlindung');
    	return $data;
    }
    
    function penerangan() {
    	$data = array('1' => 'Listrik PLN', '2' => 'Listrik Non PLN', '3' => 'Tidak Ada Listrik');
    	return $data;
    }
    
    function bahanbakarmasak() {
    	$data = array('1' => 'Listrik/Gas/LPJ', '2' => 'Lainnya');
    	return $data;
    }
    
    function fasilitasbab() {
    	$data = array('1' => 'Sendiri', '2' => 'Bersama/Umum', '3' => 'Tidak Ada');
    	return $data;
    }
    
    function pembuangantinja() {
    	$data = array('1' => 'Tangki/SPAL', '2' => 'Lainnya');
    	return $data;
    }

    function akun($id = '') {
        $jabatan = $this->session->userdata('jabatan');
        $idakun = $this->session->userdata('idakun');
        //if($jabatan != 'admin') $this->db->where('idakun', $idakun);
        
    	$query = $this->db->get('ta.ms_akun')->result_array();
    	foreach ($query as $key) {
    		$data[$key['idakun']] = $key['nama'];
    	}
    	return $data;
    }

    function akun2() {
        $this->db->order_by('jabatan', 'asc');
        $idakun = $this->session->userdata('idakun');
        $this->db->where('idakun<>', $idakun);
        $query = $this->db->get('ta.ms_akun')->result_array();
        foreach ($query as $key) {
            $data[$key['idakun']] = $key['nama'] . " <b>[" . $key['jabatan'] ."]</b>";
        }
        return $data;
    }

    function validator($id = '') {
        $jabatan = $this->session->userdata('jabatan');
        $idakun = $this->session->userdata('idakun');
        //if($jabatan != 'admin') $this->db->where('idakun', $idakun);
        $data[''] = "Belum Ada Validasi";
        $query = $this->db->get('ta.ms_akun')->result_array();
        foreach ($query as $key) {
            $data[$key['idakun']] = $key['nama'];
        }
        return $data;
    }

    function provinsi($empty = '') {
        $query = $this->db->get('ta.ms_provinsi')->result_array();
        if($empty) $data[''] = '';
        foreach ($query as $key) {
            $data[$key['idprovinsi']] = $key['namaprovinsi'];
        }
        return $data;
    }

    function kabupaten() {
        $query = $this->db->get('ta.ms_kabupaten')->result_array();
        foreach ($query as $key) {
            $data[$key['idkabupaten']] = $key['namakabupaten'];
        }
        return $data;
    }

    function kecamatan() {
        // $this->db->order_by('namakecamatan', 'asc');
        $query = $this->db->get('ta.ms_kecamatan')->result_array();
        foreach ($query as $key) {
            $data[$key['idkecamatan']] = $key['namakecamatan'];
        }
        return $data;
    }

    function desa($val = false) {
        if($val) $this->db->where('idkecamatan', '010_19_35');
        $query = $this->db->get('ta.ms_desa')->result_array();
        foreach ($query as $key) {
            $data[$key['iddesa']] = $key['namadesa'];
        }
        return $data;
    }

    function keluarga($start = 0) {
        $this->db->order_by('idkeluarga', 'asc');
        $query = $this->db->get('ta.v_survey3', 1000, $start*1000)->result_array();
        foreach ($query as $key) {
            $data[$key['idkeluarga']] = $key['nama'];
        }
        return $data;
    }

    function kesejahteraan() {
        $this->db->order_by('idkesejahteraan', 'asc');
        $query = $this->db->get('ta.ms_kesejahteraan')->result_array();
        foreach ($query as $key) {
            $data[$key['idkesejahteraan']] = $key['nama'];
        }
        return $data;
    }
}

?>