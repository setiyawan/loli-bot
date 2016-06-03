<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Datakesejahteraan extends C_controller
{
	public function __construct()
    {
        parent::__construct();
        define('model', 'm_datakesejahteraan');
        define('key', 'idsurvey');
        $this->is_logged();
    }

    public function data($data)
    {
        $this->load->model('m_combo');
        $status = $this->m_combo->status();
        $jeniskelamin = $this->m_combo->jeniskelamin();
        $pendidikan = $this->m_combo->pendidikan();
        $penguasaanbangunan = $this->m_combo->penguasaanbangunan();
        $jenisatap = $this->m_combo->jenisatap();
        $jenisdinding = $this->m_combo->jenisdinding();
        $jenislantai = $this->m_combo->jenislantai();
        $airminum = $this->m_combo->airminum();
        $penerangan = $this->m_combo->penerangan();
        $bahanbakarmasak = $this->m_combo->bahanbakarmasak();
        $fasilitasbab = $this->m_combo->fasilitasbab();
        $pembuangantinja = $this->m_combo->pembuangantinja();

        $akun = $this->m_combo->akun();
        $provinsi = $this->m_combo->provinsi();
        $kabupaten = $this->m_combo->kabupaten();
        $kecamatan = $this->m_combo->kecamatan();
        $desa = $this->m_combo->desa(true);
        $keluarga = $this->m_combo->keluarga(true);
        $validator = $this->m_combo->validator();

        if(!empty($data)) {
            $a_data['input'][] = array('key' => 'idsurvey', 'label' => 'Id Survey', 'type' => 'T', 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'idakun', 'label' => 'Nama Surveyor', 'type' => 'S', 'option' => $akun, 'hidden' => true, 'readonly' => true);
        }

        $a_data['input'][] = array('key' => 'idprovinsi', 'label' => 'Provinsi', 'type' => 'S', 'option' => $provinsi, 'hidden' => true, 'readonly' => true, 'add' => 'onchange="changekabupaten(this)"');
        $a_data['input'][] = array('key' => 'idkabupaten', 'label' => 'Kabupaten', 'type' => 'S', 'option' => $kabupaten, 'hidden' => true, 'readonly' => true, 'add' => 'onchange="changekecamatan(this)"');
        $a_data['input'][] = array('key' => 'idkecamatan', 'label' => 'Kecamatan', 'type' => 'S', 'option' => $kecamatan, 'hidden' => true, 'readonly' => true, 'add' => 'onchange="changedesa(this)"');
        $a_data['input'][] = array('key' => 'iddesa', 'label' => 'Desa', 'type' => 'S', 'option' => $desa, 'hidden' => true, 'readonly' => true, 'add' => 'onchange="changekeluarga(this)"');
        
        if(!empty($data)) {
            $a_data['input'][] = array('key' => 'idkeluarga', 'label' => 'Nama Keluarga', 'type' => 'S', 'option' => $keluarga, 'hidden' => false, 'readonly' => true);

            $a_data['input'][] = array('key' => 'hasil', 'label' => 'Indeks Kemiskinan', 'type' => 'N', 'hidden' => false, 'readonly' => true);
            $a_data['input'][] = array('key' => 'lattitude', 'label' => 'Lattitude', 'type' => 'T', 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'longitude', 'label' => 'Longitude', 'type' => 'T', 'hidden' => true, 'readonly' => true);

            $a_data['input'][] = array('key' => 'jeniskelamin', 'label' => 'Jenis Kelamin', 'type' => 'S', 'option' => $jeniskelamin, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'umur', 'label' => 'Umur', 'type' => 'T', 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'pendidikan', 'label' => 'Pendidikan', 'type' => 'S', 'option' => $pendidikan, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'pekerjaan', 'label' => 'Gaji', 'type' => 'T', 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'jmlhindividu', 'label' => 'Jumlah Individu', 'type' => 'T', 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'penguasaanbangunan', 'label' => 'Penguasaan Bangunan', 'type' => 'S', 'option' => $penguasaanbangunan, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'jenisatap', 'label' => 'Jenis Atap', 'type' => 'S', 'option' => $jenisatap, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'jenisdinding', 'label' => 'Jenis Dinding', 'type' => 'S', 'option' => $jenisdinding, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'jenislantai', 'label' => 'Jenis Lantai', 'type' => 'S', 'option' => $jenislantai, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'airminum', 'label' => 'Air Minum', 'type' => 'S', 'option' => $airminum, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'penerangan', 'label' => 'Penerangan', 'type' => 'S', 'option' => $penerangan, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'bahanbakarmasak', 'label' => 'Bahan Bakar Memasak', 'type' => 'S', 'option' => $bahanbakarmasak, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'fasilitasbab', 'label' => 'Fasilitas BAB', 'type' => 'S', 'option' => $fasilitasbab, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'pembuangantinja', 'label' => 'Tempat Pembuangan Tinja', 'type' => 'S', 'option' => $pembuangantinja, 'hidden' => true, 'readonly' => true);
            $a_data['input'][] = array('key' => 'tglsurvey', 'label' => 'Tgl Survey', 'type' => 'D', 'hidden' => false, 'readonly' => true);
            $a_data['input'][] = array('key' => 'isvalid', 'label' => 'Valid?', 'type' => 'S', 'option' => $status, 'hidden' => false, 'readonly' => false);
            $a_data['input'][] = array('key' => 'idvalidator', 'label' => 'Validator', 'type' => 'S', 'option' => $validator, 'hidden' => false, 'readonly' => true);
            $a_data['input'][] = array('key' => 'tglvalidasi', 'label' => 'Tgl Validasi', 'type' => 'D', 'hidden' => false, 'readonly' => true);

            $a_data['tab'][] = array('key' => 'identitas', 'label' => 'Identitas', 'row' => 9);
            $a_data['tab'][] = array('key' => 'sdm', 'label' => 'SDM', 'row' => 5);
            $a_data['tab'][] = array('key' => 'infrastruktur', 'label' => 'Infrastruktur', 'row' => 9);
            $a_data['tab'][] = array('key' => 'validasi', 'label' => 'Validasi', 'row' => 4);
        } else
        $a_data['input'][] = array('key' => 'tk_kemiskinan', 'label' => 'Tingkat Kemiskinan', 'type' => 'S', 'option' => $this->m_combo->kesejahteraan(), 'hidden' => false, 'readonly' => false);
        
        $a_data['script'] = 'survey';
        $a_data['label'] = 'Tingkat Kesejahteraan Masyarakat';
        $a_data['p_key'] = 'idsurvey';
        $a_data['sync'] = false;
        $a_data['direction'] = true;
        // $a_data['filter'] = $this->m_combo->status(true);

        //variabel request
        $this->load->model('m_auth');
        $a_auth = $this->m_auth->role();

        $a_data['c_insert'] = $a_auth['c_insert'];
        $a_data['c_edit'] = $a_auth['c_edit'];
        $a_data['c_delete'] = $a_auth['c_delete'];
        
        if(!empty($data)) return array_merge($data, $a_data);
        else
            return $a_data;
    }

    public function input($a_data)
    {
        $a_data = $this->data($a_data);

        $this->load->view('header');
        $this->load->view('inc_data-02', $a_data);
        $this->load->view('footer');
    }

    public function getlist($a_data='')
    {
        $a_data = $this->data($a_data);
        $this->load->view('header');
        $this->load->view('inc_repp', $a_data);
        $this->load->view('footer');
    }

    public function getall($data='')
    {
        $a_filter = array();
        $a_filter = $this->input->post();
        $reqpage = 0;
        $page = $this->input->post('page');
        $valid = $this->input->post('valid');
        print_r($a_filter);
        if($valid == null) $valid = -1;
        if($valid != -1) $a_filter['isvalid'] = $valid;
        
        if(!empty($page)) $reqpage = $page * 1000;
        $this->is_logged();
        $this->load->model(model);
        $a_data = $this->{model}->getall($reqpage, $a_filter);
        $a_data['datacount'] = ceil($this->{model}->datacount()/1000);
        
        if(!empty($data)) {
            $a_data['message'] = $data['message'];
            $a_data['code'] = $data['code'];
        }
        else
            $a_data['message'] = "";
        
        $a_data['page'] = $reqpage/1000;
        $a_data['valid'] = $valid;
        $this->input($a_data);
    }

    public function update()
    {
        $data = $this->input->post();
        $data['idvalidator'] = $this->session->idakun;
        $data['tglvalidasi'] = date('Y-m-d');
        $this->load->model(model);
        $data = $this->{model}->reduce($data);
        $a_data = $this->{model}->update($data);
        $this->getall($a_data);
    }

    public function cetak()
    {
        $a_filter = array();
        $a_filter = $this->input->post();
        $reqpage = 0;
        $page = $this->input->post('page');
        $valid = $this->input->post('valid');
        print_r($a_filter);
        if($valid == null) $valid = -1;
        if($valid != -1) $a_filter['isvalid'] = $valid;
        
        if(!empty($page)) $reqpage = $page * 1000;
        $this->is_logged();
        $this->load->model(model);
        $a_data = $this->{model}->cetak($reqpage, $a_filter);
        $a_data['datacount'] = ceil($this->{model}->datacount()/1000);
        
        if(!empty($data)) {
            $a_data['message'] = $data['message'];
            $a_data['code'] = $data['code'];
        }
        else
            $a_data['message'] = "";
        
        $a_data['page'] = $reqpage/1000;
        $a_data['valid'] = $valid;
        $a_data = $this->data($a_data);
        $a_data = array_merge($a_data, $a_filter);
        $this->load->view('inc_rep', $a_data);
    }
}