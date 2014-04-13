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
    function validateUserLogin($useremail,$password){
        $this->load->library('session');
        $returnArray = array();
        $password = md5($password);
        $returnArray["message"]="Communication error";
        $returnArray["status"]=false;
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
}
?>
