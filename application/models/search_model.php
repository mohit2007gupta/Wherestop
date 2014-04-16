<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Search_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    function getSearchSuggestion(){
        $this->load->model('Element_model','elementmodel');
        return $this->elementmodel->getAllElement("some_param");
    }
}
?>
