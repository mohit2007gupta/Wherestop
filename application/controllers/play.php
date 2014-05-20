<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Play extends CI_Controller {
	public function index()
	{
            $this->load->model('Common_model','commonmodel');
            $data['header'] = $this->commonmodel->getHeaderData();
            //$this->load->view('template/header_play',$data);
            $this->load->view('play');
            //$this->load->view('template/footer');
	}
}