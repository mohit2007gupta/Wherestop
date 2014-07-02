<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Element_model extends CI_Model {

    var $id = '';
    var $title = '';
    var $slug = '';
    var $component_id = '';
    var $description = '';
    var $placeId = '';
    var $countryId = '';
    var $latitude;
    var $longitude;
    var $localities;
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    function _isElementExist(){
        $dataQuery = "select * from element where id = \"".$this->id."\"";
        $query = $this->db->query($dataQuery);    
        if ($query->num_rows()>0){
            return true;
        }
        return false;
    }
    function setElementId($elementId){
        $this->id = $elementId;
        if($this->_isElementExist()){
            return $this->id;
        }
        return false;
    }
    function _setElementModel($elementInfo){
        // TODO: ...
    }
    function getElementId(){
        return $this->id;
    }
    function getAllElement($params){
        $dataQuery = "select * from element";
        $query = $this->db->query($dataQuery);
        $elementList = $query->result_array();
        $returnArray = array();
        //$this->load->model('component/Component_model','componentmodel');
        foreach($elementList as $elementTmp){
            /*$componentId = $elementTmp['component_id'];
            $componentInfo = $this->componentmodel->getComponentDetail($componentId);
            $tempArr = $elementTmp;
            unset($tempArr['component_id']);
            $tempArr['component_info'] = $componentInfo[0];
             * 
             */
            array_push($returnArray,$elementTmp );
        }
        return $returnArray;
    }
    function getElementIdFromSlug($slugId){
        $dataQuery = "select id from element where slug =\"".$slugId."\"";
        $query = $this->db->query($dataQuery);
        if ($query->num_rows()>0){
            $elementObj = $query->result();
            return $elementObj[0]->id;
        }
        return FALSE;
    }
    function getElementDetailForRest(){
        $modelResponse = $this->getElementDetail();
        //print_r($modelResponse);
        $toReturn = $modelResponse;
        // getting related photos
        $this->load->model('album/Album_model','albummodel');
        $this->albummodel->elementId = $this->id;
        $toReturn['album'] = $this->albummodel->getAlbumForRest();
//        $toReturn['widget'] = $modelResponse['widget'];
//        $toReturn['widgetdata'] = $modelResponse['widgetdata'];
//        $toReturn['component'] = $modelResponse['component'];
        return $toReturn;
    }
    function _getRegisterdComponent(){
        $dataQuery = "select distinct(c.id), c.name, c.slug from element_component as ec, component as c where ec.elementId = \"".$this->id."\" and ec.componentId = c.id";
        $query = $this->db->query($dataQuery);
        $componentMapList = $query->result();
        return $componentMapList;
    }
    function xgetComponentData($component,$id=null){
        if(!$this->id){
            $this->id=$id;
        }
        $this->load->model('component/Component_model','componentCoreModel');
        $componentModelUrl = $this->componentCoreModel->getComponentModelUrl($component);
        $this->load->model($componentModelUrl,"x");
        echo "<br />";
        print_r($this->x);
        unset($this->x);
        return "Fals";
    }
    function getComponentData($db,$elementId){
        //echo $db;
        //echo "--------------";
        //echo $com = substr($db, 4);
        //$url = "component/".ucfirst($com)."_model";
        //echo $url;
        //$c = new Element_model();
        //$c->load->model($url,"c");
        //print_r($this->c);
        $dataQuery = "select * from ".$db." where elementId = \"".$elementId."\"";
        $query = $this->db->query($dataQuery);
        $elementDetail = $query->result();
        $c = "";
        return (array) $elementDetail[0];
    }
    private function _getContact($elementId){
        $dataQuery = "select * from element_contact where elementId = \"".$elementId."\" and valid=\"1\"";
        $query = $this->db->query($dataQuery);
        $response = $query->result_array();
        return $response;
    }
    function getElementDetail(){
        $dataQuery = "select * from element where id = \"".$this->id."\"";
        $query = $this->db->query($dataQuery);
        $elementDetail = $query->result();
        //$this->_setElementModel($elementDetail[0]);
        $returnArray = (array) $elementDetail[0];
        $returnArray['contact'] = $this->_getContact($this->id);
        $dataQuery = "select * from place where id = \"".$returnArray['placeId']."\"";
        $query = $this->db->query($dataQuery);
        if($query->num_rows()){
            $placeDetail = $query->result_array();
            //$returnArray['place'] = $placeDetail[0];
        }
        
        if($returnArray['countryId']<=0){
            $returnArray['countryId']=99;
        }
        $dataQuery = "select * from country where id = \"".$returnArray['countryId']."\"";
        $query = $this->db->query($dataQuery);
        $countryDetail = $query->result_array();
        $returnArray['country'] = $countryDetail[0];
        $this->getElementLocalities();
        $returnArray['localities'] = $this->localities;
        
        $registeredComponents = (array) $this->_getRegisterdComponent();
        
        $this->load->model('component/Component_model','componentmodel');
        $allComponents = $this->componentmodel->getAllComponent();
        $arrTemp = array();
        $arrTempData = array();
        foreach($registeredComponents as $registeredComponent){
            $tempComp = (array) $registeredComponent;
            array_push($arrTemp, $tempComp['id']);
            array_push($arrTempData, $tempComp['name']);
        }
        $registeredComponents = $arrTemp;
        $returnArray['component'] = $arrTempData;
        //print_r($registeredComponents);
        foreach($allComponents as $com){
            $com = (array) $com;
            $tempCompId = $com['id'];
            //print_r($com);
            if(in_array($com['id'], $registeredComponents)){
                $componentAvailability[$com['name']]=true;
                //$componentData[$com['name']] = $this->getComponentData($com['dataDB'], $this->id);
            }else{
                $componentAvailability[$com['name']]=false;
                $componentData[$com['name']] = array();
            }
        }
        
        // eat component
        $this->load->model('component/Eat_model','eatmodel');
        $this->eatmodel->elementId = $this->id;
        $returnArray['eat'] = $this->eatmodel->getElementInfo();
        
        // stay component
        $this->load->model('component/Stay_model','staymodel');
        $this->staymodel->elementId = $this->id;
        $returnArray['stay'] = $this->staymodel->getElementInfo();
        
        
        $returnArray['componentVisible']=$componentAvailability;
        $returnArray['componentData']=$componentData;
        // set model variables
        //$this->component_id = $returnArray['component_id'];
        
        /*$componentId = $returnArray['component_id'];
        $this->load->model('Component_model','componentmodel');
        $componentDetail = $this->componentmodel->getComponentDetail($componentId);
        $this->load->model('widget/core/widget_model','widgetmodel');
        $allWidgets = $this->widgetmodel->getWidgets();
        $widgetAssociated = $componentDetail['widget'];
        $widgetAvailability = array();
        foreach($allWidgets as $widgetTemp){
            $tempWidgetId = $widgetTemp['id'];
            if(in_array($widgetTemp, $widgetAssociated)){
                $widgetAvailability[$widgetTemp['name']]=true;
            }else{
                $widgetAvailability[$widgetTemp['name']]=false;
            }
         }
        $returnArray['widget'] = $widgetAssociated;
        $returnArray['widgetvisible'] = $widgetAvailability;
        $returnArray['widgetdata'] = array();
        foreach($returnArray['widget'] as $widgetTemp){
            $returnArray['widgetdata'][$widgetTemp['name']] = $this->widgetmodel->getWidgetData($widgetTemp['id'],  $this->id);
        }
        $returnArray['component'] = $componentDetail[0];
        */
        $this->load->model("module/Comment_model","comment");
        $this->comment->elementId = $this->id;
        $returnArray['comment'] = $this->comment->getComment();
        
        $this->load->model("module/Rating_model","rating");
        $this->rating->elementId = $this->id;
        $returnArray['rating'] = $this->rating->getCommulativeRating();
        
        $this->load->model("module/Url_model","url");
        $this->url->elementId = $this->id;
        $returnArray['url'] = $this->url->getUrl();
        
        if($query->num_rows()>0){
            return $returnArray;
        }
        return FALSE;
    }
    function issetThenReturn($var){
        if(isset($var)){
            return htmlentities(trim($var)) ;
        }else{
            return "";
        }
    }
    function addWidgetData($widgetArr){
        foreach($widgetArr as $widgetTempData){
            $widgetModelPath = "widget/".$widgetTempData['name']."/".ucfirst($widgetTempData['name'])."_model";
            $this->load->model($widgetModelPath,"widgetmodel");
            $this->widgetmodel->postWidgetData($this->elementId,$widgetTempData['data']);
        }
    }
    function _updateWidgetData($widgetArr){
        foreach($widgetArr as $widgetTempData){
            $widgetModelPath = "widget/".$widgetTempData['name']."/".ucfirst($widgetTempData['name'])."_model";
            $this->load->model($widgetModelPath,"widgetmodel");
            $this->widgetmodel->updateWidgetData($this->id,$widgetTempData['data']);
        }
        return true;
    }
    function _generateSlug($title){
        $title = strtolower($title);
        return str_replace(" ", "-", $title);
        $got=false;
        $num = 1;
        do{
            $dataQuery = "select * from element where slug = \"".$title."\"";
            $query = $this->db->query($dataQuery);    
            if ($query->num_rows()>0){
                $title=$title."_".($num++);
            }else{
                $got=true;
            }
        }while(!$got);
        return $title;
    }
    function updateElement($postData){
        $returnArray = array();
        $returnArray['status'] = 0 ;
        $returnArray['message'] = "Communication error";
        //print_r($postData);
        $basicDataArr = $postData;
        //$componentDataArr = $postData['component'];
        //$widgetData = $componentDataArr['widget'];
        if(!isset($basicDataArr['description'])){
            $basicDataArr['description']="";
        }
        //print_r($postData);
        $this->id = $postData['id'];
        
        //checking place change
        $updatedPlace = $postData['place'];
        if($basicDataArr['placeId']!=$updatedPlace){
        	$this->placeId = $updatedPlace['id'];
        }else{
        	$this->placeId = $basicDataArr['placeId'];
        }
        //checking country change = 
        $updatedCountry = $postData['country'];
        if($basicDataArr['countryId']!=$updatedCountry){
        	$this->countryId=$updatedCountry['id'];
        }else{
        	$this->countryId=$basicDataArr['countryId'];
        }
        
        $dataQuery = "update element set title = \"".$this->issetThenReturn($basicDataArr['title'])."\" , slug = \"".$this->_generateSlug($this->issetThenReturn($basicDataArr['title']))."\", description  = \"".$this->issetThenReturn($basicDataArr['description'])."\" , address= \"".$this->issetThenReturn($basicDataArr['address'])."\", placeId = \"".$this->placeId."\", countryId=\"".$this->countryId."\"   where id = \"".$this->id."\"  ";
        if(!$this->db->query($dataQuery)){
            return $returnArray;
        }else{
            $this->id = $basicDataArr['id'];
        }
        
                
        //$componentId = $componentDataArr['id'];
        $this->load->model('component/Component_model','componentmodel');
        
        /*
        $componentWidgets = $this->componentmodel->getSelectedWidget($componentId);
        $widgetDataArr = array();
        foreach($componentWidgets as $componentWidgetsTemp){
            if(isset($postData['widgetdata'][$componentWidgetsTemp['name']])){
                $componentWidgetsTemp['data'] = $postData['widgetdata'][$componentWidgetsTemp['name']];
                array_push($widgetDataArr, $componentWidgetsTemp);
            }
        }
        $widgetUpdateResponse = $this->_updateWidgetData($widgetDataArr); */
        $returnArray['message']="Update successfully";
        $returnArray['status']=10;
        return $returnArray;
    }
    function addElement($postData){
        // TODO: Add element and get elementId
        //print_r($postData);
        $basicDataArr = $postData['basic'];
        $componentDataArr = $postData['component'];
        //$widgetData = $componentDataArr['widget'];
        if(!isset($basicDataArr['description'])){
            $basicDataArr['description']="";
        }
        $dataQuery = "insert into element (title, slug, description, component_id) value (\"".$this->issetThenReturn($basicDataArr['title'])."\" , \"".$this->_generateSlug($this->issetThenReturn($basicDataArr['title']))."\", \"".$this->issetThenReturn($basicDataArr['description'])."\", \"".$this->issetThenReturn($componentDataArr['id'])."\" ) ";
        if($this->db->query($dataQuery)){
            $this->elementId = mysql_insert_id();
            $returnArray['status'] = true;
            $dataQueryCount = "select count(*) from element";
            $queryCount = $this->db->query($dataQueryCount);
            $elementCountInfo = $queryCount->result_array();
            
            $returnArray['message']="Added !!!";
        }
        $componentId = $componentDataArr['id'];
        $this->load->model('component/Component_model','componentmodel');
        $componentWidgets = $this->componentmodel->getSelectedWidget($componentId);
        $widgetDataArr = array();
        foreach($componentWidgets as $componentWidgetsTemp){
            if(isset($postData['widgetdata'][$componentWidgetsTemp['name']])){
                $componentWidgetsTemp['data'] = $postData['widgetdata'][$componentWidgetsTemp['name']];
                array_push($widgetDataArr, $componentWidgetsTemp);
            }
        }
        $this->addWidgetData($widgetDataArr);
        return $returnArray;
        // TODO: Loop on all the models and add data corresponding to elementId
        
    }
    public function isValidSlug($elementslug){
        $dataQuery = "select * from element where slug = \"".$elementslug."\"";
        $query = $this->db->query($dataQuery);    
        if ($query->num_rows()>0){
            $result = $query->result_array();
            $this->id=$result[0]['id'];
            return true;
        }
        return false;
    }
    
    public function addElementPartialRest($postData){
    	$this->load->model('place/Googleplace_model','googleplacemodel');
    	$returnArray = array();
        $returnArray['status']=false;
        $returnArray['message'] = "Unable to add element";
        if(!isset($postData['title']) || trim(htmlentities($postData['title'])) == ""){
            $returnArray['message']="Title cannot be left blank.";
            return $returnArray;
        }
        if(!isset($postData['description'])){
            $postData['description']="";
        }
        $this->slug = $this->_generateSlug($this->issetThenReturn($postData['title']));
        $this->title = trim(htmlentities($this->issetThenReturn($postData['title'])));
        $this->description = htmlentities($this->issetThenReturn($postData['description']));
        $this->googleplacemodel->setGooglePlace($postData['detail']);
        $this->placeId=$this->googleplacemodel->cityId;
        $this->countryId=$this->googleplacemodel->country->id;
        $this->latitude = $this->googleplacemodel->latitude;
        $this->longitude = $this->googleplacemodel->longitude;
        // locality handle
        
        // sublocality handle
        
        $elementInsertData = array('title' => $this->title, 'slug' => $this->slug, 'description' => $this->description,'place'=>$this->googleplacemodel->formattedName, 'placeId'=> $this->placeId, 'countryId'=> $this->countryId, 'placeJson'=>json_encode($postData['detail']), 'latitude'=>$this->latitude, 'longitude'=>$this->longitude);
        if($this->db->insert('element', $elementInsertData)){
        	$this->id = $this->db->insert_id();
        	//if(isset($this->googleplacemodel->locality));
        	$this->addLocalityFromGoogleResult($this->googleplacemodel);
        	$returnArray['status']=true;
        	$returnArray['message']="Place added !!!";
        	$returnArray['element']=array();
        	$elementCity = $this->googleplacemodel->city;
        	$elementState = $this->googleplacemodel->state;
        	$elementCountry = $this->googleplacemodel->country;
        	$returnArray['element']['slug']=$this->slug;
        	$returnArray['element']['place']=$elementCity['slug'];
        	$returnArray['element']['state']=$elementState['slug'];
        	$returnArray['element']['country']=str_replace(" ","-",$elementCountry->nicename);
        }
        return $returnArray;
    }
    private function addLocalityFromGoogleResult($googlePlaceObject){
    	if(isset($googlePlaceObject->locality)){
    		$this->addLocality($googlePlaceObject->locality);
    	}
    	if(isset($googlePlaceObject->subLocalities)){
    		
    		foreach ($googlePlaceObject->subLocalities as $localityTemp){
    			$this->addLocality($localityTemp);
    		}
    	}	
    }
    private function addLocality($localityId){
    	$elementLocalityAddDatta = array('elementId' => $this->id, 'localityId' => $localityId);
    	if($this->db->insert('element_locality', $elementLocalityAddDatta)){
    		return true;	
    	}
    	return false;
    }
    private function getElementLocalities(){
    	$this->localities = array();
    	$getElementLocalitiesQueryData = "select * from element_locality where elementId = \"".$this->id."\"";
    	$getElementLocalitiesQuery = $this->db->query($getElementLocalitiesQueryData);
    	$elementLocalities = $getElementLocalitiesQuery->result_array();
    	$parentLocality = array();
    	$fetchedLocality = array();
    	$this->load->model('place/locality_model','placeLocality');
    	foreach ($elementLocalities as $elementLocality){
    		$this->placeLocality->setId($elementLocality['localityId']);
    		$localityDetail = $this->placeLocality->fetchLocalityDetail();
    		array_push($fetchedLocality,$this->placeLocality->id);
    		array_push($this->localities,$localityDetail);	
    		if($this->placeLocality->parent!=0){
    			array_push($parentLocality,$this->placeLocality->parent);
    		}
    	}
    	$getElementLocalitiesQueryData="";
    	foreach ($parentLocality as $elementLocalityId){
    		if(in_array($elementLocalityId,$fetchedLocality)){
    			continue;
    		}
    		$this->placeLocality->setId($elementLocalityId);
    		array_push($this->localities,$this->placeLocality->fetchLocalityDetail());
    	}
    }
}
?>
