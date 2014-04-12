<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Widget extends REST_Controller
{
    public function index_get(){
        $this->load->model('widget/core/Widget_model','widgetmodel');
        $widgetList = $this->widgetmodel->getWidgets();;
        if($widgetList){
            $this->response($widgetList, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    public function widgetconf_get($widgetId){
        $this->load->model('Component_model','componentmodel');
        $componentInfo = $this->componentmodel->getComponentDetail($componentId);
        $componentModel = $componentInfo[0];
        $componentModel['selectedWidget'] = $this->componentmodel->getSelectedWidget($componentId);
        $componentModel['selectedWidgetIds'] = array();
        if($widgetList){
            $this->response($widgetList, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    public function contactinfo_get(){
        $this->load->model('widget/contactinfo/Contactinfo_model','contactinfo_model');
        $getData = $this->get();
        $contectInfo = $this->contactinfo_model->getContactInfo($getData['elementId']);
        $this->load->model('Place_model','placemodel');
        $placeInfo = $this->placemodel->getPlaceDetail($contectInfo['placeId']);
        $contectInfo['place']=$placeInfo;
        if($contectInfo){
            $this->response($contectInfo, 200); // 200 being the HTTP response code
        }else{
            $this->response(array(''), 200);
        }
    }
}