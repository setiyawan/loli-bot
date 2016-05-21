<?php

require_once APPPATH.'/models/m_model.php';

class M_kesejahteraan extends M_model
{
	public function __construct()
    {
        parent::__construct();
        define('table', 'ta.ms_kesejahteraan');
        define('header', 'Tingkat Kesejahteraan');
        define('order', 'idkesejahteraan');
    }
}

?>