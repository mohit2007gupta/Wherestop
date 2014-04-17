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
    
    function insertUserLogin($signUpParameters, $userValid) {
    	$result['status'] = false;
    	$result['message'] = "communication error";
    	
    	$firstName = $signUpParameters['firstName'];
    	$lastName = $signUpParameters['lastName'];
    	$email = $signUpParameters['email'];
    	$password = $signUpParameters['password'];
    	
    	$insertQueryString = "insert into user_login(emailid, password, valid, first_name, last_name) values(\"".$email."\", 
    			\"".md5($password)."\", \"".$userValid."\", \"".$firstName."\", \"".$lastName."\")";
    	
    	log_message('info', "insertQueryString=".$insertQueryString);
    	
    	if ($this->db->query($insertQueryString)) {
    		$result['status'] = true;
    		$result['message'] = "User registered successfully.";

    		return $result;
    	}
    	
    	$result['message'] = 'User cannot be registered due to some internal problems, Please try again later.';
    	return $result;
    }
    
    function insertUserInfo() {
    	// TODO
    }
    
}
?>
