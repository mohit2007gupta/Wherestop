<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Stay_model extends CI_Model {
    public $id;
    public $elementId;
    public $stayId;
            
    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }
    public function getElementInfo($elementId=NULL){
        if(!$this->elementId){
            $this->elementId = $elementId;
        }
        if(!$this->elementId){
            return array();
        }
        $dataQuery = "select * from com_stay where elementId = \"".$this->elementId."\"";
        $query = $this->db->query($dataQuery);
        if($query->num_rows()>0){
            $response = $query->result_array();
            return $response[0];
        }else{
            return Array();
        }
        // get element information
    }
}
?>