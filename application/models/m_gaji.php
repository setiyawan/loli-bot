<?php

require_once APPPATH.'/models/m_model.php';

class M_gaji extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ms_gaji');
        define('header', 'Gaji');
        define('order', 'idgaji');
    }
}

?>