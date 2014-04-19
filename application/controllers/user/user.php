<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends WS_Controller {
        public function index()
	{
            $this->load->view('template/header',$this->headerData);
            $this->load->view('user/home');
            $this->load->view('template/footer');
	}
        public function setting()
	{
            $this->load->model('Common_model','commonmodel');
            $data['header'] = $this->commonmodel->getHeaderData();
            $this->load->view('template/header',$data);
            $this->load->view('user/account');
            $this->load->view('template/footer');
	}
}