<?php

require_once APPPATH.'/models/m_model.php';

class M_role extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.sc_role');
        define('header', 'Hak Akses Halaman');
        define('order', 'idrole');
    }
}

?>