<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Googleplace_model extends CI_Model {

    var $id;
    var $formattedName;
    var $googleId;
    var $type;
    var $country;
    var $cityId;
    var $city;
    var $stateId;
    var $state;
    var $locality;
    var $subLocalities;
    var $jsonObj;
    var $latitude;
    var $longitude;
    
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    function setGooglePlace($placeDetail){
    	// TODO: Fetch the detail from the $placeDetail and set in object
    	//d($placeDetail);
    	$this->load->model('place/Country_model','countrymodel');
    	$this->load->model('place/City_model','citymodel');
    	$this->load->model('place/City_model','statemodel');
    	$subLocalityArray = array();
    	if(isset($placeDetail['geometry']) && isset($placeDetail['geometry']['location'])){
    		$this->latitude=$placeDetail['geometry']['location']['k'];
    		$this->longitude=$placeDetail['geometry']['location']['A'];
    	}
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
    	if(!isset($cityShortName) && $localityShortName){
    		// make locality as City
    		$cityLongName=$localityLongName;
    		$cityShortName=$localityShortName;
    	}
    	$locationType = $placeDetail['types'];
    	$this->googleId=$placeDetail['id'];
    	$this->countrymodel->iso = $countryShortName;
    	$country = $this->countrymodel->getCountryDetailByIso($countryShortName);
    	$this->country=$country;
    	$stateInfo;
    	$cityInfo;
    	if(isset($stateShortName) && $stateShortName!=""){
    		$stateInfo = $this->statemodel->addPlace($stateLongName,$stateShortName,$this->country,"","","","STATE");
    	}
    	if(isset($cityShortName) && $cityShortName!=""){
    		$cityInfo = $this->citymodel->addPlace($cityLongName,$cityShortName,$this->country,"","","","CITY");
    	}
    	$this->city=$cityInfo;
    	$this->state=$stateInfo;
    	$this->statemodel->addCityToState($stateInfo['id'],$cityInfo['id']);
    	// adding locality
    	$localityId="0";
    	if($cityInfo['name']!=$localityLongName){
    		$localityId = $this->citymodel->addLocality($cityInfo['id'],$localityLongName,$localityShortName);
    	}
    	$this->subLocalities = array();
    	foreach ($subLocalityArray as $subLocalityArrayTemp){
    		$subLocalityId = $this->citymodel->addSublocality($cityInfo['id'],$localityId,$subLocalityArrayTemp['short_name'],$subLocalityArrayTemp['short_name']);
    		array_push($this->subLocalities,$subLocalityId);
    	}
    	$this->cityId = $cityInfo['id'];
    	$this->stateId = $stateInfo['id'];
    	$this->locality = $localityId;
    	$this->formattedName = $placeDetail['formatted_address'];
    	$this->jsonObj = $placeDetail;
    	$this->_save();
    	return $this;
    }
    function _save(){
    	// TODO: Save the google place into the database
    }
    
}
?>