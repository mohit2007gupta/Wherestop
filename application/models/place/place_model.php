<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Place_model extends CI_Model {

    var $name   = '';
    var $slug = '';
    var $id    = '';

    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
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
    function getPlaceDetail($placeId){
        $dataQuery = "select * from place where id = \"".$placeId."\"";
        $query = $this->db->query($dataQuery);
        if($query->num_rows()>0){
            $elementDetail = $query->result_array();
            return $elementDetail[0];
        }
        return FALSE;
    }
}
?>
