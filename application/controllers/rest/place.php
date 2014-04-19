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

class Place extends REST_Controller
{
    public function index_get(){
        $this->load->model('place/Place_model','placemodel');
        $placeList = $this->placemodel->getAllPlaces();
        $formattedPlaceArr = array();
        foreach ($placeList as $placeItem){
            $placeItem = (array)$placeItem;
            $placeItem['label']=$placeItem['name'];
            array_push($formattedPlaceArr, $placeItem);
        }
        //print_r($formattedPlaceArr);
        if($formattedPlaceArr){
            $this->response($formattedPlaceArr, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    public function filter_get(){
        $params = $this->get();
        $countryId = 0 ;
        $filter = "";
        if(isset($params['countryId'])){
            $countryId = $params['countryId'];
        }
        if(isset($params['filter'])){
            $filter = $params['filter'];
        }
        $this->load->model('place/Place_model','placemodel');
        $placeList = $this->placemodel->getPlacesFilter($countryId,$filter);
        $formattedPlaceArr = array();
        foreach ($placeList as $placeItem){
            $placeItem = (array)$placeItem;
            $placeItem['label']=$placeItem['name'];
            array_push($formattedPlaceArr, $placeItem);
        }
        if(count($formattedPlaceArr)>0){
            $this->response($formattedPlaceArr, 200); // 200 being the HTTP response code
        }else{
            $this->response($formattedPlaceArr);
        }
    }
    public function update_post(){
        $this->load->model('place/Place_model','placemodel');
        $updatePlaceResponse = $this->placemodel->updatePlace($this->post());
        if($updatePlaceResponse)
        {
            $this->response($updatePlaceResponse, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    public function add_post(){
        $this->load->model('place/Place_model','placemodel');
        $addPlaceResponse = $this->placemodel->addPlace($this->post());
        if($addPlaceResponse)
        {
            $this->response($addPlaceResponse, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t findrr any users!'), 404);
        }
    }
    public function info_get($placeId){
        $this->load->model('place/Place_model','placemodel');
        $placeInfo = $this->placemodel->getPlaceDetail($placeId);
        if($placeInfo)
        {
            $this->response($placeInfo, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('status' => 0,'message'=>"Invalid place id"), 404);
        }
    }
    function country_get($placeId=null){
    	$this->load->model('place/Country_model','countrymodel');
    	$filter = array();
    	$filter['popular']=true;
        $countryList = $this->countrymodel->getAllCountries($filter);
        if($countryList)
        {
            $this->response($countryList, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('status' => 0,'message'=> array()), 500);
        }
    }
}