<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Common_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    function getCountries(){
        $query = $this->db->get('country');
        return $query->result();
    }
    function getPlaces($param){
        $query = $this->db->get_where('place', array('countryId' => $param));
        return $query->result();
    }
    function getHeaderData(){
        $returnArray = array();
        $returnArray['isLoggedIn'] = $this->_isLoggedIn();
        if($returnArray['isLoggedIn']){
            $returnArray['loggedInUserDetail'] = $this->_getLoggedInDetails($this->_getLoggedInID());
            $returnArray['loggedInUserNameShort'] = $returnArray['loggedInUserDetail']->first_name;
			// $returnArray['loggedInUserNameShort'] = "sadd";
        }else{
            $returnArray['loggedInUserDetail'] = array();
            $returnArray['loggedInUserNameShort'] = "";
        }
        return $returnArray;
    }
    function _isLoggedIn(){
        $this->load->model('userauth/Userauth_model','userauthmodel');
        return $this->userauthmodel->isloggedIn();
    }
    function _getLoggedInID(){
        $this->load->model('userauth/Userauth_model','userauthmodel');
        return $this->userauthmodel->getLoggedInUserID();
    }
    function _getLoggedInDetails($userId){
        $this->load->model('user/User_model','userObj');
        $this->userObj->setuserID($userId);
        $userDetail = $this->userObj->fetchUserInfo();
        return $userDetail;
    }
}
?>
