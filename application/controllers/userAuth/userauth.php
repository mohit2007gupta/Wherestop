<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userauth extends CI_Controller {
        public function index()
	{
            $this->load->view('template/blank_header');
            $this->load->view('userauth/login');
            $this->load->view('template/footer');
	}
        public function login(){
            $this->load->view('template/header');
            $this->load->view('userauth/login');
            $this->load->view('template/footer');
	}
        public function forgotpassword()
	{
            $this->load->view('template/blank_header');
            $this->load->view('userauth/forgotpassword');
            $this->load->view('template/footer');
	}
        public function signup(){
            $this->load->view('template/header');
            $this->load->view('userauth/signup');
            $this->load->view('template/footer');
        }
        public function logout(){
            $this->load->model('userauth/Userauth_model','userauthmodel');
            $data = array();
            $this->userauthmodel->logoutSession();
        }
}