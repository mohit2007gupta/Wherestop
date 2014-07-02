<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class City_model extends CI_Model {

    var $id='';
    var $name;
    var $shortname;
    var $slug;
    var $type;
    var $description;
    var $countryId;
    var $cover_image;
    var $latitude;
    var $longitude;
    var $zoom;
    
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
        $this->type = "CITY";
    }
    function setPlaceId($id){
    	$this->id=$id;
    }
    function getPlaceId(){
    	return $this->id;
    }
    function arrayToObject($arr){
    	return $this;
    }
    function addPlace($name,$shortname,$countryObj,$description,$coverImage,$mapsObject,$type){
    	$this->name=$name;
    	$this->description=$description;
    	$this->cover_image=$coverImage;
    	$this->countryId=$countryObj->id;
    	if(count($mapsObject)>0){
    		if(isset($mapsObject['latitude'])){
    			$this->latitude=$mapsObject['latitude'];
    		}
    		if(isset($mapsObject['longitude'])){
    			$this->longitude=$mapsObject['longitude'];
    		}
    		if(isset($mapsObject['zoom'])){
    			$this->zoom=$mapsObject['zoom'];
    		}
    	}
    	$this->slug = $this->generateSlugFromName($this->name);
    	$alreadyPresent = $this->_isPresent($this->name,$this->countryId,$this->type);
    	if(!$alreadyPresent){
    		$dataToInsert =  array('name' => $name, 'shortname' => $shortname, 'slug' => $this->slug, 'type' => $type, 'cover_image'=> $coverImage, 'countryId'=> $this->countryId, 'description'=>$description);
    		$this->db->insert('place', $dataToInsert);
    		$this->id = $this->db->insert_id();
    	}else{
    		$dataQueryData = "select id from place where name = \"".$name."\" && countryId=\"".$this->countryId."\"";
    		$dataQuery = $this->db->query($dataQueryData);
    		$dataResult = $dataQuery->result_array();
    		$this->id = $dataResult[0]['id'];	
    	}
    	return $this->getPlaceInfo();
    }
    function getPlaceInfo(){
    	$query = $this->db->get_where('place', array('id' => $this->id));
    	$queryResult = $query->result_array();
    	return $queryResult[0];
    }
    function _isPresent($name,$countryId,$type){
    	$dataQuery = "select * from place where name = \"".$name."\" && countryId=\"".$countryId."\"";
    	$query = $this->db->query($dataQuery);
    	if ($query->num_rows()>0){
    		return true;
    	}
    	return FALSE;
    }
    function addCityToState($stateId,$cityId){
    	if(null==$stateId || null==$cityId){
    		return false;
    	}
    	$cityStateQueryData = "select * from city_state_map where cityId=\"".$cityId."\" and stateId = \"".$stateId."\"";
    	$cityStateQuery = $this->db->query($cityStateQueryData);
    	if($cityStateQuery->num_rows()>0){
    		return true;
    	}
    	$dataToInsert =  array('cityId' => $cityId, 'stateId' => $stateId);
    	$this->db->insert('city_state_map',$dataToInsert);
    	return $this->db->insert_id();
    }
    function generateSlugFromName($name){
    	$slug=str_replace(" ","-",strtolower($name));
    	return $slug;
    }
    function addSublocality($cityId,$localityId,$sublocalityLongName,$sublocalityShortName){
    	if(null==$localityId){
    		return false;
    	}
    	// check already present
    	$checkSublocalityQueryData = "select * from place_locality where name  = \"".$sublocalityLongName."\" and parent=\"".$localityId."\" and cityId = \"".$cityId."\"";
    	$checkSubLocalityQuery = $this->db->query($checkSublocalityQueryData);
    	$subLocalityId = null;
    	if($checkSubLocalityQuery->num_rows()>0){
    		// already existed return the
    		$localityDetailArr = $checkSubLocalityQuery->result_array();
    		$localityDetail = $localityDetailArr[0];
    		$localityId=$localityDetail['id'];
    	}else{
    		// add new locality
    		$dataToInsert =  array('name' => $sublocalityLongName,'parent'=>$localityId, 'shortname' => $sublocalityShortName,'cityId'=>$cityId);
    		$this->db->insert('place_locality',$dataToInsert);
    		$localityId=$this->db->insert_id();
    	}
    	return $localityId; 
    }
    function addLocality($cityId,$localityLongName,$localityShortName){
    	if(!$cityId){
    		return false;
    	}
    	$this->id=$cityId;
    	// check already exist
    	$checkLocalityQueryData = "select * from place_locality where name  = \"".$localityLongName."\" and cityId = \"".$cityId."\"";
    	$checkLocalityQuery = $this->db->query($checkLocalityQueryData);
    	$localityId = null;
    	if($checkLocalityQuery->num_rows()>0){
    		// already existed return the
    		$localityDetailArr = $checkLocalityQuery->result_array();
    		$localityDetail = $localityDetailArr[0];
    		$localityId=$localityDetail['id']; 
    	}else{
    		// add new locality
    		$dataToInsert =  array('name' => $localityLongName, 'shortname' => $localityShortName,'cityId'=>$cityId);
    		$this->db->insert('place_locality',$dataToInsert);
    		$localityId=$this->db->insert_id();
    	}
    	return $localityId;
    }
    function _save(){
    	// TODO: Save this object
    }
}
?>