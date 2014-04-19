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

class Element extends REST_Controller
{
    public function index_get(){
        $this->load->model('element/Element_model','elementmodel');
        $elementList = $this->elementmodel->getAllElement("filterparam");
        $elementDetailedList=array();
        foreach($elementList as $elementListTemp){
            $this->elementmodel->id = $elementListTemp['id'];
            array_push($elementDetailedList,$this->elementmodel->getElementDetail());
        }
        if($elementDetailedList)
        {
            $this->response($elementDetailedList, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    public function cuisine_get(){
        $this->load->model('component/Eat_model','eatmodel');
        $cuisineList = $this->eatmodel->getAllCuisine();
        $returnArray = array();
        foreach($cuisineList as $cuisine){
            $tempArr = $cuisine;
            $tempArr['label'] = $cuisine['name'];
            array_push($returnArray, $tempArr);
        }
        if($returnArray)
        {
            $this->response($returnArray, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    public function update_post(){
        $response = array();
        $response['status']=10;
        $response['message']="Communication error";
        $this->load->model('element/Element_model','elementmodel');
        $addElementResponse = $this->elementmodel->updateElement($this->post());
        $this->load->model('component/Component_model','componentmodel');
        $postWidgetData = $this->post();
        if($addElementResponse){
            $this->response($addElementResponse, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => ''), 404);
        }
        $this->response($response,200);
    }
    public function add_post(){
        $this->load->model('Element_model','elementmodel');
        $addElementResponse = $this->elementmodel->addElement($this->post());
        $this->load->model('component/Component_model','componentmodel');
        $postWidgetData = $this->post();
        unset($postWidgetData['baisc']);
        unset($postWidgetData['component']);
        if($addElementResponse['status']){
            $this->response(array('status'=>10,'message'=>"Successfullu added element."), 200); // 200 being the HTTP response code
        }else{
            $this->response(array('status'=>0,'message'=>"Error while adding element."), 200);
        }
    }
    public function addpartial_post(){
        $this->load->model('element/Element_model','elementmodel');
        $addElementResponse = $this->elementmodel->addElementPartial($this->post());
        //$this->load->model('Component_model','componentmodel');
        //$postWidgetData = $this->post();
        //unset($postWidgetData['baisc']);
        //unset($postWidgetData['component']);
        if(isset($addElementResponse['status']) && $addElementResponse['status']==true){
            $this->response(array('status'=>1,'message'=>"Successfullu added element.","element"=>$this->elementmodel), 200); // 200 being the HTTP response code
        }else{
            $message = isset($addElementResponse['message']) ? $addElementResponse['message'] : "Unable to add element";
            $this->response(array('status'=>0,'message'=>$message), 200);
        }
    }
    public function infofromslug_get($elementslug){
        $this->load->model('element/Element_model','elementmodel');
        if($this->elementmodel->isValidSlug($elementslug) && $this->elementmodel->setElementid($this->elementmodel->getElementIdFromSlug($elementslug))){
            //echo $this->elementmodel->id;
            $elemenetDetail = $this->elementmodel->getElementDetailForRest();
            $this->response($elemenetDetail, 200);
        }else{
            $this->response(array('status'=>0,'message'=>"Invalid element"), 200);
        }
    }
    public function info_get($elementId){
        $this->load->model('element/Element_model','elementmodel');
        if($this->elementmodel->setElementid($elementId)){
            $elemenetDetail = $this->elementmodel->getElementDetailForRest();
            $this->response($elemenetDetail, 200);
        }else{
            $this->response(array('status'=>0,'message'=>"Invalid element"), 200);
        }
    }
}