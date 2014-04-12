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

class Component extends REST_Controller
{
    public function index_get(){
        $this->load->model('Component_model','componentmodel');
        $componentList = $this->componentmodel->getAllComponent();
        if($componentList)
        {
            $this->response($componentList, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    public function update_post(){
        $this->load->model('Component_model','componentmodel');
        $componentList = $this->componentmodel->updateComponent($this->post());
        if($componentList)
        {
            $this->response($componentList, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    public function add_post(){
        $this->load->model('Component_model','componentmodel');
        echo "<pre>";
        print_r($this->post());
        echo "</pre>";
        //$componentList = $this->componentmodel->addComponent($this->post());
        /*if($componentList)
        {
            $this->response($componentList, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t findrr any users!'), 404);
        }
         * 
         */
    }
    public function info_get($componentId){
        $this->load->model('Component_model','componentmodel');
        $componentInfo = $this->componentmodel->getComponentDetail($componentId);
        $componentModel = $componentInfo[0];
        $componentModel['selectedWidget'] = $this->componentmodel->getSelectedWidget($componentId);
        $componentModel['selectedWidgetIds'] = array();
        foreach($componentModel['selectedWidget'] as $widgetElement){
            array_push($componentModel['selectedWidgetIds'],$widgetElement['id']);
        }
        if($componentModel)
        {
            $this->response($componentModel, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array(), 200);
        }
    }
    public function selectedwidget_get($componentId){
        $this->load->model('Component_model','componentmodel');
        $widgetList = $this->componentmodel->getSelectedWidget($componentId);
        if($widgetList){
            $this->response($widgetList,200); // 200 being the HTTP response code
        }else{
            $this->response($widgetList,200);
        }
    }
    function founders_get(){
        $returnArray = array();
        array_push($returnArray, "mohit");
        array_push($returnArray, "BHupendra");
        //print_r($returnArray);
        if($returnArray)
        {
            $this->response($returnArray, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
}