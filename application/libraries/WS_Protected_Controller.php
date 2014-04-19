<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
  class WS_Protected_Controller extends CI_Controller
  {
  	var $headerData;
    public function __construct()
    {
      	parent::__construct();
      	$this->load->model('Common_model','commonmodel');
      	$this->headerData['header'] = $this->commonmodel->getHeaderData();
    }
  }
?>