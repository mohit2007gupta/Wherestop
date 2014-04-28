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
    	 
    	$name = $postParameters['name'];
    	$email = $postParameters['email'];
    	$password = $postParameters['password'];

    	// check for blank or null value
    	if ($this->isNullOrEmptyString($name) || $this->isNullOrEmptyString($email) 
    			|| $this->isNullOrEmptyString($password)) {    		
    		$validateResult['status'] = false;
    		$validateResult['message'] = 'Blank values are not allowed.';
    		
    		return $validateResult;
    	}

    	// validate email address expression and already existing check
    	if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
    		if (($this->fetchUserLogin($email)) == null) {
    			$validateResult['status'] = true;
    			$validateResult['message'] = 'Email address valid.';
    		} else {
    			$validateResult['status'] = false;
    			$validateResult['message'] = 'User already exists.';
    		}
    	} else {
    		$validateResult['status'] = false;
    		$validateResult['message'] = 'Invalid email address.';
    	}
    		
    	return $validateResult;
    }
    
	function fetchUserLogin($useremail) {
		$query = $this->db->get_where('user_login', array('emailid'=>$useremail));
		
		if ($query->num_rows()>0) {
			return $query->row();
		}
		
		return null;
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
