<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Rating_model extends CI_Model {
    public $id;
    public $elementId;
    public $rating;
    public $userId;
    public $timestamp;
    
    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }
    private function calculateCommulativeRating($ratingArr){
        // mapped to 100
        $i=0;
        foreach ($ratingArr as $x){
            $i++;
        }
        if($i>0){
            return (array_sum($ratingArr)/$i);
        }else{
            return 0;
        }
        //return $ratingArr;
    }
    private function getRating(){
        $dataQuery = "select * from mod_rating where elementid = \"".$this->elementId."\"";
        $query = $this->db->query($dataQuery);
        $ratingList = $query->result_array();
        return $ratingList;
    }
    public function getCommulativeRating(){
        $ratingList = $this->getRating();
        $ratingArr = array();
        foreach ($ratingList as $rating){
            array_push($ratingArr, $rating['rating']);
        }
        return $this->calculateCommulativeRating($ratingArr);
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