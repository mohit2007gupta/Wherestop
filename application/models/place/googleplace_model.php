<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Googleplace_model extends CI_Model {

    var $id;
    var $googleId;
    var $type;
    var $country;
    
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    function setGooglePlace($placeDetail){
    	// TODO: Fetch the detail from the $placeDetail and set in object
    	print_r($placeDetail);
    	$this->load->model('place/Country_model','countrymodel');
    	$this->load->model('place/City_model','citymodel');
    	$this->load->model('place/City_model','statemodel');
    	$subLocalityArray = array();
    	foreach ($placeDetail['address_components'] as $addressComponentTemp){
    		if(in_array("country",$addressComponentTemp['types'])){
    			$countryShortName = $addressComponentTemp['short_name'];
    		}
    		if(in_array("administrative_area_level_1",$addressComponentTemp['types'])){
    			$stateShortName = $addressComponentTemp['short_name'];
    			$stateLongName = $addressComponentTemp['long_name'];
    		}
    		if(in_array("administrative_area_level_2",$addressComponentTemp['types'])){
    			$cityShortName = $addressComponentTemp['short_name'];
    			$cityLongName = $addressComponentTemp['long_name'];
    		}
    		if(in_array("locality",$addressComponentTemp['types'])){
    			$localityShortName = $addressComponentTemp['short_name'];
    			$localityLongName = $addressComponentTemp['long_name'];
    		}
    		if(in_array("sublocality",$addressComponentTemp['types'])){
    			$subLocalityArrayTemp = array();
    			$subLocalityArrayTemp['short_name'] = $addressComponentTemp['short_name'];
    			$subLocalityArrayTemp['long_name'] = $addressComponentTemp['long_name'];
    			array_push($subLocalityArray,$subLocalityArrayTemp);
    		}
    	}
    	$locationType = $placeDetail['types'];
    	$this->googleId=$placeDetail['id'];
    	$this->countrymodel->iso = $countryShortName;
    	$country = $this->countrymodel->getCountryDetailByIso($countryShortName);
    	$this->country=$country;
    	$stateInfo;
    	$cityInfo;
    	if($stateShortName!=""){
    		$stateInfo = $this->statemodel->addPlace($stateLongName,$stateShortName,$this->country,"","","","STATE");
    	}
    	if($cityShortName!=""){
    		$cityInfo = $this->citymodel->addPlace($cityLongName,$cityShortName,$this->country,"","","","CITY");
    	}
    	$this->statemodel->addCityToState($stateInfo['id'],$cityInfo['id']);
    	// adding locality
    	$this->city->addLocality($this->city->id,$localityLongName,$localityShortName);
    	$this->_save();
    	return $this;
    }
    function _save(){
    	// TODO: Save the google place into the database
    }
    
}
?>