<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
            //$this->load->model('Common_model','commonmodel');
            //$data['header'] = $this->commonmodel->getHeaderData();
            $this->load->view('template/header');
            $this->load->view('welcome');
            $this->load->view('template/footer');
	}
}