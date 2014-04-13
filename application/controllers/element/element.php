<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Element extends CI_Controller {
        public function index()
	{
            //$this->load->view('list_city/city_home');
            $this->load->view('place/list_element');
	}
        public function elementview($param=null){
            $this->load->view('template/header');
                $this->load->view('element/elementview');
                $this->load->view('template/footer');
        }
        public function view($paramPri=null){
            $validPage = true;
            $this->load->model('Common_model','commonmodel');
            $data['header'] = $this->commonmodel->getHeaderData();
            $this->load->model('Component_model','frontComponentModel');
            $this->load->model('Element_model','ElementModel');
            $componentTemplate = "common";
            /*
            if($validPage && $data['componentDetail'] && $data['elementDetail'] && ($componentId!=$data['elementDetail']['component_id'])){
                $redirectURL = "view/".$data['elementDetail']['component']['slug']."/".$paramSec;
                if(isset($paramTer) && $paramTer!=null){
                    $redirectURL.="/".$paramTer;
                }
                $this->load->helper('url');
                redirect($redirectURL);
                $componentTemplate = $data['elementDetail']['component']['fronttemplate'];
            }
            */
            $elementId = $this->ElementModel->setElementId($paramPri);
            if(!$elementId){
                $elementId = $this->ElementModel->getElementIdFromSlug($paramPri);
                $this->ElementModel->setElementId($elementId);
            }
            if($elementId){
                $data['elementId']=$elementId;
                $data['elementDetail']=$this->ElementModel->getElementDetail($elementId);
            }else{
                $data['elementId']=false;
                $validPage=false;
            }
            if($validPage){
                $this->load->view('template/header',$data);
                $this->load->view('element/componenttemplate/'.$componentTemplate,$data);
                $this->load->view('template/footer');
            }else{
                $this->load->view('template/blank_header',$data);
                $this->load->view('404_page');
            }
            //$this->load->view('template/footer');
        }
        public function edit($paramPri=null){
            $validPage = true;
            $this->load->model('Common_model','commonmodel');
            $data['header'] = $this->commonmodel->getHeaderData();
            $this->load->model('Component_model','frontComponentModel');
            $this->load->model('Element_model','ElementModel');
            $componentTemplate = "common";
            /*
            if($validPage && $data['componentDetail'] && $data['elementDetail'] && ($componentId!=$data['elementDetail']['component_id'])){
                $redirectURL = "view/".$data['elementDetail']['component']['slug']."/".$paramSec;
                if(isset($paramTer) && $paramTer!=null){
                    $red    irectURL.="/".$paramTer;
                }
                $this->load->helper('url');
                redirect($redirectURL);
                $componentTemplate = $data['elementDetail']['component']['fronttemplate'];
            }
            */
            $elementId = $this->ElementModel->setElementId($paramPri);
            if(!$elementId){
                $elementId = $this->ElementModel->getElementIdFromSlug($paramPri);
                $this->ElementModel->setElementId($elementId);
            }
            if($elementId){
                $data['elementId']=$elementId;
                $data['elementDetail']=$this->ElementModel->getElementDetail($elementId);
            }else{
                $data['elementId']=false;
                $validPage=false;
            }
            if($validPage){
                $this->load->view('template/header',$data);
                $this->load->view('element/componenttemplateedit/'.$componentTemplate,$data);
                $this->load->view('template/footer');
            }else{
                $this->load->view('template/blank_header',$data);
                $this->load->view('404_page');
            }
            //$this->load->view('template/footer');
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */