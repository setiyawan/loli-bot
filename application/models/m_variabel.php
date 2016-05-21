<?php

require_once APPPATH.'/models/m_model.php';

class M_variabel extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ms_variabel');
        define('header', 'Variabel');
        define('order', 'idparent');
    }
}

?>