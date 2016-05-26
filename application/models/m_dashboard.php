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
}

?>