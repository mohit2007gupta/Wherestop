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
    
    function setEmail($userEmail) {
    	$this->email = $userEmail;
    }
    function getEmail(){
    	return $this->email;
    }
    
    function fetchUserInfo(){
        $dataQuery = "select * from user_info where userid = \"".$this->userID."\"";
        $query = $this->db->query($dataQuery);
        $userDetail = $query->result();
        return $userDetail[0];
    }
    
    function insertUserLogin($userEmail, $userPassword, $userValid) {
    	$result['status'] = false;
    	$result['message'] = "communication error";
    	
    	$insertQueryString = "insert into user_login(emailid, password, valid) values(\"".$userEmail."\", 
    			\"".md5($userPassword)."\", \"".$userValid."\")";
    	
    	if ($this->db->query($insertQueryString)) {
    		$result['status'] = true;
    		$result['message'] = "User registered successfully.";

    		return $result;
    	}
    	
    	$result['message'] = 'User cannot be registered due to some internal probllems, Please try again later.';
    	return $result;
    }
    
    function insertUserInfo() {
    	// TODO
    }
    
}
?>
