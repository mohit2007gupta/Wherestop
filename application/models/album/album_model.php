<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Album_model extends CI_Model {

    var $id;
    var $elementId;
    
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    function getElementId(){
        return $elementId;
    }
    function setElementId($elementId){
        $this->elementId = $elementId;
    }
    function getAlbums(){
        $retursnArray = array();
        if(!isset($this->elementId)){
            return $retursnArray;
        }
        $dataQuery = "select * from mod_album where elementId =\"".$this->elementId."\"";
        $query = $this->db->query($dataQuery);
        if ($query->num_rows()>0){
            $queryResult = $query->result();
            foreach ($queryResult as $result) {
                array_push($retursnArray, $result);
            }
        }
        return $retursnArray;
    }
    function getAlbumForRest(){
        $albums = $this->getAlbums();
        $this->load->model('album/Photo_model','photomodel');
        $toReturn = array();
        foreach($albums as $album){
            //echo $album->id;
            $this->photomodel->setAlbumId($album->id);
            $album->photos = $this->photomodel->getAlbumPhotoForRest();
            array_push($toReturn, $album);
        }
        //$toReturn = $albums;
        return $toReturn;
    }
    function createAlbum($elementId){
        
    }
    
    function getPlaceIdFromSlug($slugId){
        $dataQuery = "select id from place where slug =\"".$slugId."\"";
        $query = $this->db->query($dataQuery);
        if ($query->num_rows()>0){
            $placeObj = $query->result();
            return $placeObj[0]->id;
        }
        return FALSE;
    }
}
?>
