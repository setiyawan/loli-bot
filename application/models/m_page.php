<?php

require_once APPPATH.'/models/m_model.php';

class M_page extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.sc_page');
        define('header', 'Halaman');
        define('order', 'idpage');
    }
}

?>