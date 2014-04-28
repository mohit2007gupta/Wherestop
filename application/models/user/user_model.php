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
    	// user_info table
        $dataQuery = "select * from user_login where id = \"".$this->userID."\"";
        $query = $this->db->query($dataQuery);
        $userDetail = $query->result();
        return $userDetail[0];
    }
    
    function insertUserLogin($signUpParameters, $userValid) {
    	//user_login table
		$result = array('status'=>false, 'message'=>'communication error', 'userLoginId'=>null);
    	
    	$name = $signUpParameters['name'];
    	$firstName = trim(substr($name,0,strrpos($name," ")));
    	$lastName = trim(substr($name,strrpos($name," ")));
    	$email = $signUpParameters['email'];
    	$password = $signUpParameters['password'];
    	
    	$userLoginObject = array(
    			'emailid'		=>	$email,
    			'password'		=>	md5($password),
    			'valid'			=> 	$userValid,
    			'first_name'	=> 	$firstName,
    			'last_name'		=> 	$lastName
    	);

    	if ($this->db->insert('user_login', $userLoginObject)) {
    		$result['status'] = true;
    		$result['message'] = "User registered successfully.";
    		$result['userLoginId'] = $this->db->insert_id();
    		
    		return $result;
    	}
    	
    	return $result;
    }
    
    function removeUserLogin($userEmail){
    	// user_login table
    	$result = array('status'=>false, 'message'=>'communication error');
    	
    	$deleteQueryString = "delete from user_login where emailid= \"".$userEmail."\"";
    	if ($this->db->query($deleteQueryString)) {
    		$result['status'] = true;
    		$result['mmessage'] = 'Record deleted from user_login table having emailid='.$userEmail;
    	}
    	
    	return $result;
    }
    
    function insertUserRegistration($activationCode, $userLoginId, $activationLink) {
    	// user_registration table
    	$result = array('status'=>false, 'message'=>'communication error');

    	$userRegistrationObject = array(
    			'activation_code'	=> 	$activationCode,
    			'user_login_id'		=> 	$userLoginId,
    			'activation_link'	=> 	$activationLink
    	);
    	
    	if ($this->db->insert('user_registration', $userRegistrationObject)) {
    		$result['status'] = true;
    		$result['message'] = 'Entry added into user_registration table';
    	}
    	
    	return $result;
    }
    
    function removeUserRegistration($userEmail) {
    	// user_registration table
    	$result = array('status'=>false, 'message'=>'communication error');
    	
    	$deleteQueryString = "DELETE FROM user_registration ur, user_login ul 
    			WHERE ur.user_login_id = ul.id AND ul.emailid = \"".$userEmail."\"";
    	
    	if ($this->db->query($deleteQueryString)) {
    		$result['status'] = true;
    		$result['message'] = 'Record deleted from user_registration whose emailid in user_login ='.$userEmail;
    	}
    	
    	return $result;
    }
    
    function fetchUserRegistrationDetails($userEmail, $activationCode) {
    	// user_registration table
    	$queryString = "SELECT ur.*
    			FROM user_registration ur, user_login ul
    			WHERE ur.activation_code = \"".$activationCode."\" AND ur.user_login_id = ul.id 
    					AND ul.emailid = \"".$userEmail."\" AND ul.active=0";
    	
    	log_message('info', "fetchUserRegistrationDetail Query = ".$queryString);
    	
    	$fetchQuery = $this->db->query($queryString);
		
    	if ($fetchQuery->num_rows() > 0) {
    		return $fetchQuery->row_array();
    	}

    	return null;
    }
    
    function activateUser($userEmail, $activationCode) {
    	// user_login table
    	$result = array('status'=>false, 'message'=>'communication error');
    	
    	// update active field to TRUE in user_login table
		$updateActiveFlagQuery = "UPDATE user_login 
				SET active = 1 
				WHERE emailid = \"".$userEmail."\"";
		
		if ($this->db->query($updateActiveFlagQuery)) {
			$result['status'] = true;
			$result['message'] = 'User with email = '.$userEmail.' is activated successfully, Welcome to the world of Wherestop.';
		}
    	
    	return $result;
    }
    
    // queries related to new_password table
    function addNewPasswordRecord($newPasswordObject){
    	if (!($this->db->insert('new_password', $newPasswordObject))) {
    		throw new Exception('Cannot insert new password object, user_login_id='.$newPasswordObject['user_login_id']);
    	}
    }
    
    function removeNewPasswordRecord($userEmail){
    	$sqlQuery = "DELETE 
    			FROM new_password np, user_login ul
    			WHERE np.user_login_id = ul.id AND ul.emailid=?";
    	
    	if (!$this->db->query($sqlQuery, array($userEmail))) {
    		throw new Exception('Cannot remove new password object.'.$userEmail);
    	}
    }
    
    function fetchNewPasswordRecord($userEmail, $activationCode){
    	$sqlQueryString = "SELECT np.* 
    			FROM new_password np, user_login ul 
    			WHERE np.activation_code=? AND np.user_login_id = ul.id 
    				AND ul.emailid=?";
    	
    	$query = $this->db->query($sqlQueryString, array($activationCode, $userEmail));

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	}
    	
    	return null;
    }
    
    function addUpdateNewPasswordRecord(){
    	// TODO
    }
    
}
?>
