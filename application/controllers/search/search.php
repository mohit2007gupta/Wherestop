<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userauth extends CI_Controller {
        public function index()
	{
            $this->load->view('template/blank_header');
            $this->load->view('search/index');
            $this->load->view('template/footer');
	}
}