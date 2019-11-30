<?php

class Controller_Error extends Controller{
  
  function index(){
    $this->error404();
  }

  function error404(){
    $this->view->generate('error/error404_view.php', 'template_home.php');
  }
}