<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Component_model extends CI_Model {

    var $componentName   = '';
    var $id = '';
    var $componentSlug    = '';
    var $componentLogo = '';

    function __construct(){
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    
    function getAllComponent()
    {
        $query = $this->db->get('component');
        return $query->result();
    }
    
    function _isComponentExist($componentId){
        $dataQuery = "select * from component where id =\"".$componentId."\"";
        $query = $this->db->query($dataQuery);
        if ($query->num_rows()>0){
            return true;
        }
        return false;
    }
    function generateSlug($name){
        return strtolower($name);
    }
    function addComponent($postData){
        $returnArray = array();
        $returnArray['status']=false;
        $returnArray['message']="Unknown error";
        if(isset($postData['id']) && $this->_isComponentExist($postData['id'])){
            return $returnArray;
        }
        if(!isset($postData['name'])){
            $returnArray['message'] = "Invalid Name 1";
            return $returnArray;
        }
        if(trim(htmlentities($postData['name'])) == ""){
            $returnArray['message'] = "Invalid Name 2";
            return $returnArray;
        }
        echo $dataQuery = "insert into component ( name, slug) value (\"".trim(htmlentities($postData['name']))."\" , \"".$this->generateSlug(trim(htmlentities($postData['name'])))."\" ) ";
        if($this->db->query($dataQuery)){
            $returnArray['status'] = true;
            $returnArray['message']="Added !!!";
            return $returnArray;
        }
        return $returnArray;
    }
    function updateComponent($postData){
        $returnArray = array();
        $returnArray['status']=false;
        $returnArray['message']="Unknown error";
        if($this->_isComponentExist($postData['id'])){
            $dataQuery = "update component set name = \"".$postData['name']."\" , slug = \"".$this->generateSlug($postData['name'])."\" where id = \"".$postData['id']."\"";
            if($this->db->query($dataQuery)){
                $returnArray['status'] = true;
                $returnArray['message']="Updated !!!";
            }
        }
        // updating selected widgets
        
        return $returnArray;
    }
    function getComponentIdFromSlug($slugId){
        $dataQuery = "select id from component where slug =\"".$slugId."\"";
        $query = $this->db->query($dataQuery);
        if ($query->num_rows()>0){
            $comonentObj = $query->result();
            return $comonentObj[0]->id;
        }
        return FALSE;
    }
    function getComponentDetail($componentId){
        $dataQuery = "select * from component where id = \"".$componentId."\"";
        $query = $this->db->query($dataQuery);
        $componentDetail = array();
        if($query->num_rows()>0){
            $componentDetail =  $query->result_array();
        }
        //$componentDetail['widget'] = $this->getSelectedWidget($componentId);
        return $componentDetail;
    }
    function getComponentSlug($componentId){
        $dataQuery = "select slug from component where id = \"".$componentId."\"";
        $query = $this->db->query($dataQuery);
        if ($query->num_rows()>0){
            $comonentObj = $query->result();
            return $comonentObj[0]->slug;
        }
        return FALSE;
    }
    function getSelectedWidget($componentId){
        $returnArray = array();
        $dataQuery = "select w.id, w.name, w.label, w.description from component_widget as cw, widget as w where w.id = cw.widget_id and cw.component_id = \"".$componentId."\"";
        $query = $this->db->query($dataQuery);
        $selectedWidgetSQLResponse = $query->result_array();
        foreach($selectedWidgetSQLResponse as $temp){
            array_push($returnArray, $temp);
        }
        return $returnArray;
    }
    function getComponentModelUrl($component){
        if(!$this->_isComponentExist($component->id)){
            return false;
        }
        $modelUrl = "component/".ucfirst($component->slug)."_model";
        return $modelUrl;
    }
    function getComponentData($component,$elementId){
        echo $component->name;
        if(!$this->_isComponentExist($component->id)){
            return false;
        }
        $componentInfo = $this->getComponentDetail($component->id);
        $modelUrl = "component/".ucfirst($component->slug)."_model";
        $this->load->model($modelUrl,'abc');
        echo "<br />";
        print_r($this->abc);
        return $this->abc->getElementInfo($elementId);
    }
    function getData($component,$elementId){
        $com = new Component_model();
        //$widgetModel = new Widget_model();
        echo $com->componentName = $component->name;
        echo $com->componentSlug = $component->slug;
        $path = "component/".ucfirst($component->slug)."_model";
        $com->load->model($path,'ssss');
        echo "_____________";
        print_r($com->ssss->getElementInfo($elementId));
        echo ".................";
        return "yes";
        /*
        $this->widgetName = $widgetModel->getWidgetNameById($widgetId);
        $widgetModelPath = "widget/".$this->widgetName."/".ucfirst($this->widgetName)."_model";
        $this->load->model($widgetModelPath,"dynamicwidget");
        return $this->dynamicwidget->getElementData($elementId);
         * 
         */
    }
    function getComponentModel($component){
        if(!$this->_isComponentExist($component->id)){
            return false;
        }
        $componentInfo = $this->getComponentDetail($component->id);
        $modelUrl = "component/".ucfirst($component->slug)."_model";
        $this->load->model($modelUrl,'abc');
        return $this->abc;
    }
}
?>