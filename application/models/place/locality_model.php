<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Locality_model extends CI_Model {

    var $id='';
    var $name;
    var $shortname;
    var $parent;
    var $cityId;
    
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    function setId($id){
    	$this->id=$id;
    }
    function getId(){
    	return $this->id;
    }
    function arrayToObject($arr){
    	return $this;
    }
    function fetchLocalityDetail(){
    	$getLocalityDetailQueryData = "select * from place_locality where id = \"".$this->id."\"";
    	$getLocalityDetailQuery = $this->db->query($getLocalityDetailQueryData);
    	$getLocalityDetail=array();
    	if($getLocalityDetailQuery->num_rows()>0){
    		$getLocalityDetailArr = $getLocalityDetailQuery->result_array();
    		if(isset($getLocalityDetailArr[0])){
    			$getLocalityDetail=$getLocalityDetailArr[0];
    		}else{
    			$getLocalityDetail=$getLocalityDetailArr;
    		}
    		$this->name=$getLocalityDetail['name'];
    		$this->shortname=$getLocalityDetail['shortname'];
    		$this->parent=$getLocalityDetail['parent'];
    		$this->cityId=$getLocalityDetail['cityId'];
    		return $getLocalityDetail;
    	}
    	return null;
    }
}
?>