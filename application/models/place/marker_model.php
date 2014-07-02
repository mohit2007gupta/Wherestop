<?php

/*
 * To change this template, choose Tools | Templates
* and open the template in the editor.
*/
class Marker_model extends CI_Model {

	var $latitude;
	var $longitude;
	var $showWindow;
	var $title;
	var $icon;

	function __construct()
	{
		$this->load->database();
		parent::__construct();
	}
	function _getNearByMarkers($latitude,$longitude){
		$minLongitude=$longitude-1;
		$maxLongitude=$longitude+1;
		$minLatitude=$latitude-1;
		$maxLatitude=$latitude+1;
		$getNearbyQueryData="select * from element where longitude <= \"".$maxLongitude."\" and longitude >= \"".$minLongitude."\" and latitude <= \"".$maxLatitude."\" and latitude >= \"".$minLatitude."\" ";
		$getNearbyQuery = $this->db->query($getNearbyQueryData);
		$returnArr = array();
		$getNearbyArray = $getNearbyQuery->result_array();
		foreach ($getNearbyArray as $nearbyTemp){
			$markerTemp = array();
			$markerTemp['longitude']=$nearbyTemp['longitude'];
			$markerTemp['latitude']=$nearbyTemp['latitude'];
			$markerTemp['title']=$nearbyTemp['title'];
			array_push($returnArr,$markerTemp);
		}
		return $returnArr;
	}
	function getNearby($latitude,$longitude){
		$returnArray = array();
		$returnArray['status']=false;
		$returnArray['message']="Unknown error";
		if(null==$latitude || null==$longitude){
			$returnArray['message']="Invalid center of map.";
			return $returnArray;
		}
		$nearByMarkers = $this->_getNearByMarkers($latitude,$longitude);
		if($nearByMarkers){
			$returnArray['markers']=$nearByMarkers;
			$returnArray['status']=true;
			$returnArray['message']="Near by location fetched";
		}
		return $returnArray;
	}
}
?>