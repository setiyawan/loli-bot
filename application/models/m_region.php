<?php

require_once APPPATH.'/models/m_model.php';

class M_region extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ms_daerah');
        define('header', 'Daerah');
        define('order', 'idregion');
    }
}

?>