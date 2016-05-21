<?php

class M_auth extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

    public function role()
    {
        $page = $this->uri->segment(1);
        $jabatan = $this->session->userdata['jabatan'];

    	$sql = $this->db->query("select c_insert, c_edit, c_delete from ta.sc_role r join ta.sc_page p on p.idpage = r.idpage 
    		where page = '$page' and jabatan = '$jabatan'");
        $sql = $sql->result_array();
        
        if(!empty($sql))
    	   return $sql[0];
        else
            return show_404();
    }
}