<?php

class Controller_Producto extends Controller{
    function listado(){
        $data = $this->model->loadData();

        $this->view->generate(
            'product_list_view.php',
            'template_view.php',
            $data
        );

    }

    function index(){
        $this->view->generate('main_view.php', 'template_view.php');
    }
}