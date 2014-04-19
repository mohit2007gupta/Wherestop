<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Comment_model extends CI_Model {
    public $id;
    public $elementId;
    public $comment;
    public $userId;
    
    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }
    public function getComment(){
        $dataQuery = "select * from mod_comment where elementid = \"".$this->elementId."\"";
        $query = $this->db->query($dataQuery);
        $commentList = $query->result_array();
        return $commentList;
    }
    public function addComment(){
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