<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Url_model extends CI_Model {
    public $id;
    public $elementId;
    public $facebook;
    
    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }
    public function getUrl(){
        $dataQuery = "select * from mod_url where elementId = \"".$this->elementId."\"";
        $query = $this->db->query($dataQuery);
        if($query->num_rows()>0){
            $urlArr = $query->result_array();
            return $urlArr[0];
        }else{
            return Array();
        }
    }
    public function addUrl(){
        if(!$this->elementId || !$this->userId){
            return false;
        }
        $dataQuery = "insert into mod_comment (elementId, comment, userId) values (\"".$this->elementId."\",\"".$this->comment."\",\"".$this->userId."\")";
        if($this->db->query($dataQuery)){
            return true;
        }
        return false;
    }
}
?>