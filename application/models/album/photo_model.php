<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Photo_model extends CI_Model {

    var $id;
    var $albumId;
    var $host;
    var $path;
    var $media;
    var $url;
    
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    function getAlbumId(){
        return $this->albumId;
    }
    function setAlbumId($albumId){
        $this->albumId = $albumId;
    }
    function getPhotos(){
        $retursnArray = array();
        if(!isset($this->albumId)){
            return $retursnArray;
        }
        $dataQuery = "select * from mod_photo where albumId =\"".$this->albumId."\"";
        $query = $this->db->query($dataQuery);
        if ($query->num_rows()>0){
            $queryResult = $query->result();
            foreach ($queryResult as $result) {
                array_push($retursnArray, $result);
            }
        }
        return $retursnArray;
    }
    function prepareUrl($host,$path,$media){
        if($host =="0"){
            $host = base_url();
        }
        return prep_url($host.$path.$media);
    }
    function getAlbumPhotoForRest(){
        $photos = $this->getPhotos();
        $toReturn = array();
        foreach ($photos as $photo){
            $photo->url = $this->prepareUrl($photo->host, $photo->path, $photo->media);
            array_push($toReturn, $photo);
        }
        return $toReturn;
    }
}
?>
