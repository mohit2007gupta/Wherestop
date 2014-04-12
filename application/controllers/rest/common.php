<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Common extends REST_Controller
{
    public function countries_get(){
        $this->load->model('Common_model','commonmodel');
        $countryList = $this->commonmodel->getCountries();
        if($countryList)
        {
            $this->response($countryList, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array(), 404);
        }
    }
    public function places_get($param){
        $this->load->model('Common_model','commonmodel');
        $placeList = $this->commonmodel->getPlaces($param);
        $response = array();
        if($placeList){
            $response=$placeList;
        }
        $this->response($response, 200);
    }
}