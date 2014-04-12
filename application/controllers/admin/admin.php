<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('userAuth/Userauth_model','userauthenticationmodel');
        $this->load->helper('url');
        if(!$this->userauthenticationmodel->isloggedIn()){
            redirect("my404");
        }
    }
    public function dashboard(){
        $this->load->model('Common_model','commonmodel');
        $this->load->model('Component_model','componentmodel');
        $this->load->model('widget/core/Widget_model','widgetmodel');
        $data['header'] = $this->commonmodel->getHeaderData();
        $data['componentList'] = $this->componentmodel->getAllComponent();
        $this->load->view("template/adminheader",$data);
        $this->load->view("admin/dashboard");
        $this->load->view("template/footer");
    }
    public function element(){
        $this->load->model('Common_model','commonmodel');
        $this->load->model('Component_model','componentmodel');
        $this->load->model('widget/core/Widget_model','widgetmodel');
        $data['header'] = $this->commonmodel->getHeaderData();
        $data['componentList'] = $this->componentmodel->getAllComponent();
        $this->load->view("template/adminheader",$data);
        $this->load->view("admin/dashboard");
        $this->load->view("template/footer");
    }
    public function component(){
            $this->load->model('Common_model','commonmodel');
            $this->load->model('Component_model','componentmodel');
            $this->load->model('widget/core/Widget_model','widgetmodel');
            $data['header'] = $this->commonmodel->getHeaderData();
            $data['componentList'] = $this->componentmodel->getAllComponent();
            $this->load->view("template/adminheader",$data);
            $this->load->view("admin/component");
            $this->load->view("template/footer");
    }
    public function place(){
            $this->load->model('Common_model','commonmodel');
            $this->load->model('Component_model','componentmodel');
            $data['header'] = $this->commonmodel->getHeaderData();
            $data['componentList'] = $this->componentmodel->getAllComponent();
            $this->load->view("template/adminheader",$data);
            $this->load->view("admin/component");
            $this->load->view("template/footer");
    }
}