<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/controllers/c_controller.php';

class Region extends C_controller
{
    public function __construct()
    {
        parent::__construct();
        define('model', 'm_region');
        define('key', 'iddaerah');
        $this->is_logged();
    }
}

?>