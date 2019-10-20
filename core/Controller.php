<?php

class Controller {

    //public $model;
    //public $view;

    function __construct(){
        $this->view = new View();
    }

    public function sendRequest($uri) {
        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$uri);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);
        return json_decode($result, true);
    }

    function index(){
    }
}