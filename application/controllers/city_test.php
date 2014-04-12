<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            //$this->load->view('list_city/city_home');
            $this->load->view('city/list_city');
	}
        public function view($param=null) {
            $data['title']="Individual city listing";
            $data['city_name_parameter']=$param;
            $this->load->view('city/view_city',$data);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */