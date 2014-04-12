<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Place extends CI_Controller {

	public function index()
	{
            $this->load->view('template/header');
            $this->load->view('place/index');
            $this->load->view('template/footer');
	}
        public function view($param=null) {
            /*
            $this->load->model('Common_model','commonmodel');
            $data['header'] = $this->commonmodel->getHeaderData();
            $data['title']="Individual city listing";
            $data['city_name_parameter']=$param;
            $data['city_id']="";
            $validPage = true;
            $this->load->model('place/Place_model','placemodel');
            $placeId = $this->placemodel->getPlaceIdFromSlug($param);
            $data['cityDetail']=array();
            if($placeId){
                $data['placeDetail']=$this->placemodel->getPlaceDetail($placeId);
                $this->load->view('template/header',$data);
                $this->load->view('place/view_city',$data);
            }else{
                $this->load->view('template/blank_header');
                $this->load->view('404_page');
            }*/
            $this->load->view('template/header');
            $this->load->view('place/index');
            $this->load->view('template/footer');
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */