<?php

require_once APPPATH.'/models/m_model.php';

class M_wisata extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'public.ms_wisata');
        define('header', 'Wisata');
        define('order', 'id_wisata');
    }
}

?>