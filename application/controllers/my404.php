<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class my404 extends CI_Controller 
{
    public function __construct()   {
            parent::__construct();  
    }
    public function index() 
    {
        $this->load->view('template/header');
        $this->load->view('404_page');//loading in my template
        $this->load->view('template/footer');
    }
}

?>