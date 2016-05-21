<?php

require_once APPPATH.'/models/m_model.php';

class M_provinsi extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ms_provinsi');
        define('header', 'Provinsi');
        define('order', 'idprovinsi');
    }
}

?>