<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Home extends C_controller
{
    public function __construct()
    {
        parent::__construct();
        define('model', 'm_dashboard');
        define('model2', 'm_survey');
        $this->is_logged();
    }

    public function datainput($data)
    {
        if(!empty($this->input->post('page'))) $start = $this->input->post('page');
        else $start = 0;
        $this->load->model('m_combo');
        $status = $this->m_combo->status();
        $jeniskelamin = $this->m_combo->jeniskelamin();
        $pendidikan = $this->m_combo->pendidikan();
        $gaji = $this->m_combo->gaji();
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
        $keluarga = $this->m_combo->keluarga($start);
        $validator = $this->m_combo->validator();

        $a_data['input'][] = array('key' => 'idsurvey', 'label' => 'Id Survey', 'type' => 'T', 'hidden' => true, 'readonly' => true);
        $a_data['input'][] = array('key' => 'idakun', 'label' => 'Nama Surveyor', 'type' => 'S', 'option' => $akun, 'hidden' => true, 'readonly' => true);
        $a_data['input'][] = array('key' => 'tglsurvey', 'label' => 'Tgl Survey', 'type' => 'D', 'hidden' => false, 'readonly' => true);
        $a_data['input'][] = array('key' => 'idprovinsi', 'label' => 'Provinsi', 'type' => 'S', 'option' => $provinsi, 'hidden' => true, 'readonly' => true, 'add' => 'onchange="changekabupaten(this)"');
        $a_data['input'][] = array('key' => 'idkabupaten', 'label' => 'Kabupaten', 'type' => 'S', 'option' => $kabupaten, 'hidden' => true, 'readonly' => true, 'add' => 'onchange="changekecamatan(this)"');
        $a_data['input'][] = array('key' => 'idkecamatan', 'label' => 'Kecamatan', 'type' => 'S', 'option' => $kecamatan, 'hidden' => true, 'readonly' => true, 'add' => 'onchange="changedesa(this)"');
        $a_data['input'][] = array('key' => 'iddesa', 'label' => 'Desa', 'type' => 'S', 'option' => $desa, 'hidden' => true, 'readonly' => true, 'add' => 'onchange="changekeluarga(this)"');
        $a_data['input'][] = array('key' => 'idkeluarga', 'label' => 'Nama Keluarga', 'type' => 'S', 'option' => $keluarga, 'hidden' => false, 'readonly' => true);

        $a_data['input'][] = array('key' => 'lattitude', 'label' => 'Lattitude', 'type' => 'T', 'hidden' => true, 'readonly' => true);
        $a_data['input'][] = array('key' => 'longitude', 'label' => 'Longitude', 'type' => 'T', 'hidden' => true, 'readonly' => true);

        $a_data['input'][] = array('key' => 'jeniskelamin', 'label' => 'Jenis Kelamin', 'type' => 'S', 'option' => $jeniskelamin, 'hidden' => true, 'readonly' => true);
        $a_data['input'][] = array('key' => 'umur', 'label' => 'Umur', 'type' => 'T', 'hidden' => true, 'readonly' => true);
        $a_data['input'][] = array('key' => 'pendidikan', 'label' => 'Pendidikan', 'type' => 'S', 'option' => $pendidikan, 'hidden' => true, 'readonly' => true);
        $a_data['input'][] = array('key' => 'pekerjaan', 'label' => 'Sektor Pekerjaan', 'type' => 'S', 'option' => $gaji, 'hidden' => true, 'readonly' => true);
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
               
        $a_data['tab'][] = array('key' => 'identitas', 'label' => 'Identitas', 'row' => 9);
        $a_data['tab'][] = array('key' => 'sdm', 'label' => 'SDM', 'row' => 5);
        $a_data['tab'][] = array('key' => 'infrastruktur', 'label' => 'Infrastruktur', 'row' => 9);

        $a_data['script'] = 'survey';
        $a_data['label'] = 'Hasil Survey';
        $a_data['p_key'] = 'idsurvey';
        $a_data['sync'] = false;
        $a_data['direction'] = true;
        //$a_data['filter'] = $this->m_combo->status(true);

        //variabel request
        // $this->load->model('m_auth');
        // $a_auth = $this->m_auth->role();

        // $a_data['c_insert'] = $a_auth['c_insert'];
         $a_data['c_edit'] = true;
        // $a_data['c_delete'] = $a_auth['c_delete'];
        
        return array_merge($data, $a_data);
    }

    public function index()
    {
        $a_filter = array();
        $reqpage = 0;

        $a_filter['isvalid'] = null;
        
        if(!empty($page)) $reqpage = $page * 1000;
        $this->is_logged();
        $this->load->model(model2);
        $a_data = $this->{model2}->getall($reqpage, $a_filter);
        
        if(!empty($data)) {
            $a_data['message'] = $data['message'];
            $a_data['code'] = $data['code'];
        }
        else
            $a_data['message'] = "";
        
        
        $a_data = $this->datainput($a_data);
        
        $this->load->model(model);
        $data = $this->{model}->datacount();
        $data['tabelkecamatan'] = $this->{model}->tabelkecamatan();

        $a_data = array_merge($data, $a_data);
    	$this->load->view('header');
    	$this->load->view('home', $a_data);
    	$this->load->view('footer');
    }


    public function finish()
    {
        $data = $this->input->post();
        print_r($data);
        die();
    }

    public function proses()
    {
        $idsurvey = $this->input->post('idsurvey');
        $a_filter = array();
        $reqpage = 0;

        $a_filter['idsurvey'] = $idsurvey;
        
        if(!empty($page)) $reqpage = $page * 1000;
        $this->is_logged();
        $this->load->model(model2);
        $a_data = $this->{model2}->getall($reqpage, $a_filter); 


        $a_data['message'] = "Data Survey Berhasil Dipilih";
       
        $a_data = $this->datainput($a_data);
        
        $this->load->model(model);
        $data = $this->{model}->datacount();
        $data['tabelkecamatan'] = $this->{model}->tabelkecamatan();
        $data['idsurvey'] = $idsurvey;
        $data['pekerjaan'] = $this->m_dashboard->getVariabel($idsurvey);
        $data['kesejahteraan'] = $this->m_dashboard->getKesejahteraan();
        $data['hasil'] = $this->m_dashboard->getKeluarga($idsurvey);
        $a_data = array_merge($data, $a_data);
        $this->load->view('header');
        $this->load->view('proses', $a_data);
        $this->load->view('footer');
    }

    public function data()
    {
        $this->load->model(model);
        $a_data = $this->{model}->chart();
        echo json_encode($a_data);
    }

    public function grafik()
    {
        $this->load->model(model);
        $a_data = $this->{model}->grafik();
        echo json_encode($a_data);
    }

    public function hampirmiskin()
    {
        $this->load->model(model);
        $a_data = $this->{model}->hampirmiskin();
        echo json_encode($a_data);
    }

    public function miskin()
    {
        $this->load->model(model);
        $a_data = $this->{model}->miskin();
        echo json_encode($a_data);
    }

    public function sangatmiskin()
    {
        $this->load->model(model);
        $a_data = $this->{model}->sangatmiskin();
        echo json_encode($a_data);
    }
}

?>