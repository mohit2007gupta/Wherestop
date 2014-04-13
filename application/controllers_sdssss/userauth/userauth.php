<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userauth extends CI_Controller {
        public function index()
	{
            $this->load->view('template/blank_header');
            $this->load->view('userauth/login');
            $this->load->view('template/footer');
	}
        public function login(){
            $this->load->helper('url');
            $this->load->model('userauth/Userauth_model','userauthmodel');
            $data = array();
            if($this->userauthmodel->isloggedIn()){
                redirect("/");
            }
            if($this->input->post()){
                $postDataArray = $this->input->post();
                $getUserAuthReturnArray = $this->userauthmodel->validateUserLogin($postDataArray['email'],  $postDataArray['password']);
                $data['postResult']=$getUserAuthReturnArray;
                if($getUserAuthReturnArray['status']){
                    redirect("/");
                }
            }
            $this->load->view('template/blank_header');
            $this->load->helper('url');
            $this->load->view('userauth/login',$data);
            $this->load->view('template/footer');
	}
        public function forgotpassword()
	{
            $this->load->view('template/blank_header');
            $this->load->view('userauth/forgotpassword');
            $this->load->view('template/footer');
	}
        public function signup(){
            $this->load->view('template/blank_header');
            $this->load->view('userauth/signup');
            $this->load->view('template/footer');
        }
        public function logout(){
            $this->load->model('userauth/Userauth_model','userauthmodel');
            $data = array();
            $this->userauthmodel->logoutSession();
        }
}