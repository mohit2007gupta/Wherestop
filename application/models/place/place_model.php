<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Place_model extends CI_Model {

    var $placeName   = '';
    var $id = '';
    var $placeSlug    = '';

    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    
    function getAllPlaces()
    {
        $query = $this->db->get('place');
        $places = $query->result_array();
        $formattedPlace = array();
        foreach($places as $place){
            $countryId = $place['countryId'];
            $placeTemp = $place;
            $placeTemp['country']= $this->getCountryInfo($countryId);
            array_push($formattedPlace, $placeTemp);
        }
        return $formattedPlace;
    }
    function getPlacesFilter($countryId,$filter){
        if($countryId==0){
            $dataQuery = "select * from place where name like \"".$filter."%\"";
        }else{
            $dataQuery = "select * from place where countryId =\"".$countryId."\" and name like \"".$filter."%\"";
        }
        $query = $this->db->query($dataQuery);
        $places = $query->result_array();
        $formattedPlace = array();
        foreach($places as $place){
            $countryId = $place['countryId'];
            $placeTemp = $place;
            $placeTemp['country']= $this->getCountryInfo($countryId);
            array_push($formattedPlace, $placeTemp);
        }
        return $formattedPlace;
    }
    function getCountryInfo($countryId){
        $dataQuery = "select * from country where id =\"".$countryId."\"";
        $query = $this->db->query($dataQuery);
        if ($query->num_rows()>0){
            $countryInfo = $query->result_array();
            return $countryInfo[0];
        }
        return false;
    }
    function getPlaceIdFromSlug($slugId){
    	$dataQuery = "select id from place where slug =\"".$slugId."\"";
    	$query = $this->db->query($dataQuery);
    	if ($query->num_rows()>0){
    		$placeObj = $query->result();
    		return $placeObj[0]->id;
    	}
    	return FALSE;
    }
    function _isPlaceExist($placeId){
        $dataQuery = "select * from place where id =\"".$placeId."\"";
        $query = $this->db->query($dataQuery);
        if ($query->num_rows()>0){
            return true;
        }
        return false;
    }
    function generateSlug($name){
        return strtolower($name);
    }
    function addPlace($postData){
        $returnArray = array();
        $returnArray['status']=false;
        $returnArray['message']="Unknown error";
        if(isset($postData['id']) && $this->_isPlaceExist($postData['id'])){
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
        $dataQuery = "insert into place ( name, slug) value (\"".trim(htmlentities($postData['name']))."\" , \"".$this->generateSlug(trim(htmlentities($postData['name'])))."\" ) ";
        if($this->db->query($dataQuery)){
            $returnArray['status'] = true;
            $returnArray['message']="Added !!!";
            return $returnArray;
        }
        return $returnArray;
    }
    function updatePlace($postData){
        $returnArray = array();
        $returnArray['status']=false;
        $returnArray['message']="Unknown error";
        if($this->_isPlaceExist($postData['id'])){
            $dataQuery = "update place set name = \"".$postData['name']."\" , slug = \"".$this->generateSlug($postData['name'])."\" where id = \"".$postData['id']."\"";
            if($this->db->query($dataQuery)){
                $returnArray['status'] = true;
                $returnArray['message']="Updated !!!";
            }
        }
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
    function getPlaceDetail($placeId){
        $dataQuery = "select * from  country as c, place as p where p.id = \"".$placeId."\" && p.countryId = c.id";
        $query = $this->db->query($dataQuery);
        if($query->num_rows()>0){
            $returnArray = $query->result_array();
            $returnArray = $returnArray[0];
            return $returnArray;
        }
        return FALSE;
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
}
?>