<?php

require_once APPPATH.'/models/m_model.php';

class M_dashboard extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table1', 'ta.ms_keluarga');
        define('table2', 'ta.ke_survey3');
        //define('table3', 'ta.ke_survey3');
    }

    public function datacount()
    {
    	$data['total'] = $this->db->count_all_results(table1);
    	$data['record'] = $this->db->count_all_results(table2);
    	$this->db->where('isvalid', '1');
		$this->db->from(table2);
		$data['valid'] = $this->db->count_all_results();
		$this->db->where('isvalid', '0');
		$this->db->from(table2);
		$data['invalid'] = $this->db->count_all_results();
    	return $data;
    }

    public function chart()
    {
    	$data['y'] = $this->db->count_all_results(table1);
    	$data['a'] = $this->db->count_all_results(table2);
    	$this->db->where('isvalid', '1');
		$this->db->from(table2);
		$data['b'] = $this->db->count_all_results();
		$this->db->where('isvalid', '0');
		$this->db->from(table2);
		$data['c'] = $this->db->count_all_results();
    	return $data;
    }

    public function grafik()
    {
    	$q = $this->db->query("select k.namakecamatan, coalesce(p.pertama, 0) as pertama, coalesce(d.kedua, 0) as kedua, coalesce(t.ketiga,0) as ketiga from ta.v_keluarga k
			left join 
			(
				select idkecamatan, namakecamatan, count(idkecamatan) as pertama from ta.v_keluarga k
				left join " . table2 ." s on s.idkeluarga = k.idkeluarga  where hasil >= (select batasbawah from ta.ms_kesejahteraan where idkesejahteraan = 1) and hasil < (select batasatas from ta.ms_kesejahteraan where idkesejahteraan = 1)
				group by idkecamatan, namakecamatan, idkecamatan
			) p on k.idkecamatan = p.idkecamatan
			left join 
			(
				select idkecamatan, namakecamatan, count(idkecamatan) as kedua from ta.v_keluarga k
				left join " . table2 ." s on s.idkeluarga = k.idkeluarga  where hasil >= (select batasbawah from ta.ms_kesejahteraan where idkesejahteraan = 2) and hasil < (select batasatas from ta.ms_kesejahteraan where idkesejahteraan = 2)
				group by idkecamatan, namakecamatan, idkecamatan
			) d on d.idkecamatan = k.idkecamatan
			left join 
			(
				select idkecamatan, namakecamatan, count(idkecamatan) as ketiga from ta.v_keluarga k
				left join " . table2 ." s on s.idkeluarga = k.idkeluarga  where hasil >= (select batasbawah from ta.ms_kesejahteraan where idkesejahteraan = 3) and hasil < (select batasatas from ta.ms_kesejahteraan where idkesejahteraan = 3)
				group by idkecamatan, namakecamatan, idkecamatan
			) t on t.idkecamatan = k.idkecamatan
			group by k.idkecamatan, k.namakecamatan, p.pertama, d.kedua, t.ketiga
			order by k.idkecamatan");
		return $q->result();
    }

    public function tabelkecamatan()
    {
    	$sql = $this->db->query("select kc.namakecamatan, count(idkeluarga) as target, coalesce(masuk, 0) as masuk 
    		from ta.ms_keluarga k 
			join ta.ms_desa d on d.iddesa = k.iddesa
			left join (
				select c.idkecamatan, namakecamatan, count(s.idkeluarga) as masuk from " . table2 . "  s 
				join ta.ms_keluarga k on s.idkeluarga = k.idkeluarga
				join ta.ms_desa d on d.iddesa = k.iddesa
				join ta.ms_kecamatan c on c.idkecamatan = d.idkecamatan
				group by namakecamatan, c.idkecamatan
				order by c.idkecamatan
			) a on a.idkecamatan = d.idkecamatan
			join ta.ms_kecamatan kc on kc.idkecamatan = d.idkecamatan
			group by d.idkecamatan, kc.namakecamatan, masuk
			order by d.idkecamatan"); 
    	return $sql->result_array();
    }
    public function hampirmiskin()
    {
    	$q = $this->db->query("select namakecamatan as label, count(idkecamatan) as value from ta.v_keluarga k
		left join " . table2 ." s on s.idkeluarga = k.idkeluarga  where hasil >= (select batasbawah from ta.ms_kesejahteraan where idkesejahteraan = 1) and hasil < (select batasatas from ta.ms_kesejahteraan where idkesejahteraan = 1)
		group by idkecamatan, namakecamatan, idkecamatan
		order by value desc");
		return $q->result();
    }

    public function miskin()
    {
    	$q = $this->db->query("select namakecamatan as label, count(idkecamatan) as value from ta.v_keluarga k
		left join " . table2 ." s on s.idkeluarga = k.idkeluarga  where hasil >= (select batasbawah from ta.ms_kesejahteraan where idkesejahteraan = 2) and hasil < (select batasatas from ta.ms_kesejahteraan where idkesejahteraan = 2)
		group by idkecamatan, namakecamatan, idkecamatan
		order by value desc");
		return $q->result();
    }

    public function sangatmiskin()
    {
    	$q = $this->db->query("select namakecamatan as label, count(idkecamatan) as value from ta.v_keluarga k
		left join " . table2 ." s on s.idkeluarga = k.idkeluarga  where hasil >= (select batasbawah from ta.ms_kesejahteraan where idkesejahteraan = 3) and hasil < (select batasatas from ta.ms_kesejahteraan where idkesejahteraan = 3)
		group by idkecamatan, namakecamatan, idkecamatan
		order by value desc");
		return $q->result();
    }

    public function dashboard($idakun)
    {
    	if(!empty($idakun)) {
	    	$q = $this->db->query("
			select idakun, namadesa as iddesa, namakecamatan as idkecamatan, namakabupaten as idkabupaten, namaprovinsi as idprovinsi, 
			coalesce(sum(target), 0) as dataTarget, coalesce(sum(masuk), 0) as dataMasuk, coalesce(sum(valid), 0) as dataValid, coalesce(sum(invalid), 0) as dataInvalid from (
			select a.idakun, namadesa, namakecamatan, namakabupaten, namaprovinsi, count(k.idkeluarga) as target, count(s.idkeluarga) as masuk,
			case 
			when isvalid = '1' then count(s.idkeluarga)
			end as valid,
			case 
			when isvalid is null or isvalid = '0' then count(s.idkeluarga)
			end as invalid
			from ta.ke_akses a
			join ta.v_daerah d on a.iddesa = d.iddesa
			join ta.ms_keluarga k on k.iddesa = a.iddesa
			left join ta.ke_survey3 s on s.idkeluarga  = k.idkeluarga
			group by a.idakun, namadesa, namakecamatan, namakabupaten, namaprovinsi, isvalid
			) a where idakun = $idakun
			group by idakun, namadesa, namakecamatan, namakabupaten, namaprovinsi");

			$result['code'] = "212";
	    	$result['message'] = "Data Dashboard";
	        $result['data'] = $q->row();
	    } else
	    {
	    	$result['code'] = "515";
	    	$result['message'] = "Data Dashboard Tidak Dapat Diakses";
	        $result['data'] = null;
	    }
		return $result;
    }


    function getVariabel($idsurvey) {
        $this->db->where('idsurvey', $idsurvey);
        $dataSurvey = $this->db->get('ta.ke_survey3')->row_array();
        
        $b_umur = 15;
        $a_umur = 64;
        $umur = 1;

        if($dataSurvey['umur'] > $a_umur) $umur =  $dataSurvey['umur'] / $a_umur;
        else 
            if($dataSurvey['umur'] < $b_umur) $umur = $b_umur / $dataSurvey['umur'];
        $dataSurvey['umur'] = $umur;
        $dataSurvey['pendidikan'] = 4 - $dataSurvey['pendidikan'];
        $query = $this->db->get_where('ta.ms_gaji', array('idgaji' => $dataSurvey['pekerjaan']));
        $nominal = $query->row()->nominal;
        $dataSurvey['pekerjaan'] = ($dataSurvey['jmlhindividu'] / $nominal) * 1000000;     

        $sum = array();
        $hasil = array();
        $hasil[] = null;
        $hasil[] = null;
        $hasil[] = $dataSurvey['jeniskelamin'];
        $hasil[] = $dataSurvey['umur'];
        $hasil[] = $dataSurvey['pendidikan'];
        $hasil[] = $dataSurvey['pekerjaan'];
        $hasil[] = $dataSurvey['jmlhindividu'];
        $hasil[] = null;
        $hasil[] = $dataSurvey['penguasaanbangunan'];
        $hasil[] = $dataSurvey['jenisatap'];
        $hasil[] = $dataSurvey['jenisdinding'];
        $hasil[] = $dataSurvey['jenislantai'];
        $hasil[] = $dataSurvey['airminum'];
        $hasil[] = $dataSurvey['penerangan'];
        $hasil[] = $dataSurvey['bahanbakarmasak'];
        $hasil[] = $dataSurvey['fasilitasbab'];
        $hasil[] = $dataSurvey['pembuangantinja'];

        $this->db->order_by('idvariabel', 'asc');
        $query = $this->db->get('ta.ms_variabel')->result_array();
        
        foreach ($query as $key) {
            $data[$key['idvariabel']][] = $key['namavariabel'];
            $data[$key['idvariabel']][] = $key['bobot'];
            
            $data[$key['idvariabel']][] = $hasil[$key['idvariabel']];
            $data[$key['idvariabel']][] = $hasil[$key['idvariabel']] * $key['bobot'];
            $data[$key['idvariabel']][] = null;

            if(empty($hasil[$key['idvariabel']])) {
                $index = $key['idvariabel'];
                $sum[$index] = 0;
            } else 
            {
                $sum[$index] += ($hasil[$key['idvariabel']] * $key['bobot']);
                //$data[$key['idvariabel']][]
            }
        }

        $data[1][3] = $sum[1];
        $data[7][3] = $sum[7];

        $data[1][4] = $sum[1] * $data[1][1];
        $data[7][4] = $sum[7] * $data[7][1];

        $data[17][4] = $data[1][4] + $data[7][4];
        $kesejahteraan = $data[17][4];
        $query = $this->db->query("select nama from ta.ms_kesejahteraan 
        	where batasbawah <= $kesejahteraan and $kesejahteraan < batasatas")->row_array();
        $data[17][5] = $query['nama'];

        // print_r($data);
        // die();
        return $data;

    }

    function getKesejahteraan() {
        $this->db->order_by('idkesejahteraan', 'asc');
        $query = $this->db->get('ta.ms_kesejahteraan')->result_array();
        foreach ($query as $key) {
            $data[$key['idkesejahteraan']][] = $key['nama'];
            $data[$key['idkesejahteraan']][] = $key['batasbawah'];
            $data[$key['idkesejahteraan']][] = $key['batasatas'];
        }
        return $data;
    }

    function getKeluarga($idsurvey) {
        $this->db->where('idsurvey', $idsurvey);
        $query = $this->db->get('ta.v_survey3')->result_array();
        foreach ($query as $key) {
            $data[$key['idkeluarga']][] = $key['nama'];
            $data[$key['idkeluarga']][] = $key['alamat'];
            $data[$key['idkeluarga']][] = $key['namadesa'];
            $data[$key['idkeluarga']][] = $key['namakecamatan'];
            $data[$key['idkeluarga']][] = $key['namakabupaten'];
        }
        return $data;
    }

}

?>