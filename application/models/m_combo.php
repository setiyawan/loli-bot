<?php

class M_combo extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

    function auth() {
        $data = array('1' => 'True', '0' => 'False');
        return $data;
    }

    function status($empty = false) {
        if($empty) 
            $data = array('-1' => 'Pilih Semua', '1' => 'Valid', '0' => 'Tidak Valid');
        else
    	   $data = array( '' => '', '1' => 'Valid', '0' => 'Tidak Valid');
    	return $data;
    }

    function aktif() {
        $data = array('1' => 'Aktif', '2' => 'Non Aktif');
        return $data;
    }

    function jeniskelamin() {
    	$data = array('1' => 'Laki-laki', '2' => 'Perempuan');
    	return $data;
    }
}

?>