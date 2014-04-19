<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Eat_model extends CI_Model {
    public $id;
    public $elementId;
    public $eatId;
            
    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }
    public function getAllCuisine(){
        $dataQuery = "select * from com_eat_cuisine";
        $query = $this->db->query($dataQuery);
        $cuisineList = $query->result_array();
        return $cuisineList;
    }
    private function _getCuisine($elementId){
        $dataQuery = "select ec.cuisine from com_eat_element_cuisine as ec";
        $query = $this->db->query($dataQuery);
        $response = $query->result_array();
        $returnArray = array();
        foreach($response as $cuisine){
            array_push($returnArray, $cuisine['cuisine']);
        }
        return $returnArray;
    }
    public function getElementInfo($elementId=NULL){
        $returnArray = Array();
        if(!$this->elementId){
            $this->elementId = $elementId;
        }
        if(!$this->elementId){
            return array();
        }
        $dataQuery = "select * from com_eat where elementId = \"".$this->elementId."\"";
        $query = $this->db->query($dataQuery);
        $response = $query->result_array();
        //return "Eat me ";
        if($query->num_rows>0){
            $returnArray = $response[0];
            $returnArray['cuisine'] = $this->_getCuisine($this->elementId);
            $returnArray['timing'] = $this->_getTiming($this->elementId);
        }
        return $returnArray;
        // get element information
    }
    
    private function _getTiming($elementId){
        $returnTiming = array();
        $days = 7;
        for($i=0;$i<7;$i++){
            $returnTiming[$i]=array("start_time"=>"","end_time"=>"");
        }
        $dataQuery = "select * from com_eat_timing where elementId = \"".$elementId."\"";
        $query = $this->db->query($dataQuery);
        $response = $query->result_array();
        /*foreach($response as $timing){
            $returnTiming[$timing['day']]['start_time'] = $timing['start_time'];
            $returnTiming[$timing['day']]['end_time'] = $timing['end_time'];
        }
         * 
         */
        // optimize timing
        $defaultTiming = $returnTiming[0];
        $i=0;
        /*
        foreach ($returnTiming as $timing){
            if($timing['start_time']=="" && $timing['end_time']==""){
                $returnTiming[$i] = $defaultTiming;
            }
            $i++;
        }
         * 
         */
        //print_r($returnTiming);
        return $response;
    }
}
?>