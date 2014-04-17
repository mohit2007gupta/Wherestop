<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Userauth_model extends CI_Model {

	
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    
    function isloggedIn(){
        $this->load->library('session');
        if(!$this->session->userdata('logged_in')){
            return false;
        }
        if(!$this->_checkValidLoginSession()){
            return false;
        }
        return true;
    }
    
    function getLoggedInUserID(){
        $this->load->library('session');
        if($this->isloggedIn()){
            return $this->session->userdata('userid');
        }
        return false;
    }
    
    function _checkValidLoginSession(){
        $this->load->library('session');
        if(!$this->session->userdata('userid')){
            return false;
        }
        if(!$this->session->userdata('useremail')){
            return false;
        }
        return true;
    }
    
    function _setUserLoginSession($useremail,$userId){
        $newdata = array(
                   'useremail'  => $useremail,
                   'userid' => $userId,
                   'logged_in' => TRUE
             );
        $this->session->set_userdata($newdata);
    }
    
    function validateSignupParameters($postParameters) {
    	$validateResult = array('status'=> true, 'message'=>'parameters validated.');
    	 
    	$firstName = $postParameters['firstName'];
    	$lastName = $postParameters['lastName'];
    	$email = $postParameters['email'];
    	$password = $postParameters['password'];
    	
    	log_message('info', "params= ".$firstName.$lastName.$email.$password." ksk");
    	
    	// validate first name and last name
    	if ($this->isNullOrEmptyString($firstName) || $this->isNullOrEmptyString($lastName) 
    			|| $this->isNullOrEmptyString($email) || $this->isNullOrEmptyString($password)) {    		
    		$validateResult['status'] = false;
    		$validateResult['message'] = 'Blank values are not allowed.';
    		
    		return $validateResult;
    	}

    	// validate email address expression and already existing check
    	if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
    		$validateResult = $this->validateEmail($email);
    	} else {
    		$validateResult['status'] = false;
    		$validateResult['message'] = 'Invalid email address.';
    	}
    		
    	return $validateResult;
    }
    
	function validateEmail($useremail) {
    	$result = array();
    	
    	$emailQueryString = "select * from user_login where emailid = \"".$useremail."\"";
    	log_message('info', "emailQueryString: ".$emailQueryString);
    	
    	$emailQuery = $this->db->query($emailQueryString);
    	$resultCount = $emailQuery->num_rows();    	
    	log_message('info', "emailQueryNumRows=".$resultCount);
    	
    	if ($resultCount > 0) {
    		$result['status'] = false;	
    		$result['message'] = 'User already exists.';
    	} else {
    		$result['status'] = true;
    		$result['message'] = 'valid email entered';
    	} 
    	
    	return $result;
    }
    
    function validateUserLogin($useremail,$password){
        $this->load->library('session');
        $returnArray = array();
        $password = md5($password);
        $returnArray["message"]="Communication error";
        $returnArray["status"]=false;
        if($useremail=="" || $password==""){
        	$returnArray['message']="Fields cannot be left blank";
        	return $returnArray;
        }
        $dataQuery = "select * from user_login where emailid = \"".$useremail."\"";
        $query = $this->db->query($dataQuery);
        if($query->num_rows()==1){
            $loginDetailResult = $query->result_array();
            $loginDetail=$loginDetailResult[0];
            if($loginDetail['password'] == $password){
                $returnArray['message'] = "Authentication accepted !!!";
                $returnArray['status']= true;
                $this->_setUserLoginSession($useremail,$loginDetail['id']);
            }else{
                $returnArray['message']="Invalid details !!!";
            }
        }else{
            $returnArray["message"]="Authentication failure !!!";
        }
        return $returnArray;
    }
    
    function logoutSession(){
        $this->load->library('session');
         $this->load->helper('url');
        echo "Loggind out session....";
        print_r($this->session->all_userdata());
        $this->session->sess_destroy();
        redirect('/');
    }
    
    // fn to check null or empty string
    function isNullOrEmptyString($stringInstance) {
    	return (!isset($stringInstance) || trim($stringInstance)==='');
    }
    
}
?>
