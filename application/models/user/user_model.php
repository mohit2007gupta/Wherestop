<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class User_model extends CI_Model {
    var $userID = "";
    var $name = "";
    var $email = "";
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    function setUserID($userID){
        $this->userID = $userID;
    }
    function getUserID(){
        return $this->userID;
    }
    
    function setName($name){
        return $this->name;
    }
    function getName(){
        return $name;
    }
    
    function fetchUserInfo(){
        $dataQuery = "select * from user_info where userid = \"".$this->userID."\"";
        $query = $this->db->query($dataQuery);
        $userDetail = $query->result();
        return $userDetail[0];
    }
}
?>
