<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Example extends REST_Controller
{   
    function index_get(){
        $returnArray = array();
        array_push($returnArray, "Dipak");
        array_push($returnArray, "BHupendra");
        //print_r($returnArray);
        if($returnArray)
        {
            $this->response($returnArray, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    function founders_get(){
        $returnArray = array();
        array_push($returnArray, "mohit");
        array_push($returnArray, "BHupendra");
        //print_r($returnArray);
        if($returnArray)
        {
            $this->response($returnArray, 200); // 200 being the HTTP response code
        }else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
}