<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Country_model extends CI_Model {

    var $id   = '';
    var $iso = '';
    var $name    = '';
    var $nicename    = '';
    var $iso3    = '';
    var $numcode    = '';
    var $phonecode    = '';

    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    
    function getAllCountries($filter=null)
    {
        $query = $this->db->get('country');
        $countries = $query->result_array();
        $formattedCountries = array();
        $popularCountryList = array();
        
        if(isset($filter['popular']) && $filter['popular']==true){
        	$popularCountryList = $this->getPopularCountries();
        	foreach ($popularCountryList as $country){
        		$countryInfo = $this->getCountryInfo($country);
        		array_push($formattedCountries,$countryInfo);
        	}
        }
        if(isset($filter['limit'])){
        	$toReturnCount = trim($filter['limit']);
        }else{
        	$toReturnCount = 50;
        }
        foreach($countries as $country){
            $countryId = $country['id'];
            if(in_array($countryId,$popularCountryList)){
            	continue;
            }
            $countryTemp = $country;
            if(count($formattedCountries)>=$toReturnCount){
            	break;
            }
            array_push($formattedCountries, $countryTemp);
        }
        return $formattedCountries;
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
    function getPopularCountries(){
    	$popularCountryList = ['99','149','105','226','73','199'];
    	return $popularCountryList;
    }
}
?>