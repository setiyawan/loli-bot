<?php

require_once APPPATH.'/models/m_model.php';

class M_daerah extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ms_daerah');
        define('header', 'Daerah');
        define('order', 'id_daerah');
    }
}

?>