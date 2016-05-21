<?php

require_once APPPATH.'/models/m_model.php';

class M_kabupaten extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ms_kabupaten');
        define('header', 'Kabupaten');
        define('order', 'idkabupaten');
    }
}

?>