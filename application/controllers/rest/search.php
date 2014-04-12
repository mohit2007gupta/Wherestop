<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Search extends REST_Controller
{
    public function index_get(){
        $this->load->model('Component_model','componentmodel');
        $componentList = $this->componentmodel->getAllComponent();
        if($componentList)
        {
            $this->response($componentList, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    public function suggestions_get(){
        /*
         * response format:
         * {
         *      label: elementlabel,
         *      model: {
         *                  all model
         *             }
         * }
         */
        $this->load->model('Search_model','searchmodel');
        $searchSuggestions = $this->searchmodel->getSearchSuggestion();
        $toResponse = array();
        foreach($searchSuggestions as $searchSuggestionsTemp){
            $searchSuggestionsTemp['label']=$searchSuggestionsTemp['title'];
            array_push($toResponse, $searchSuggestionsTemp);
        }
        $this->response($toResponse, 200); // 200 being the HTTP response code
    }
}