<?php

class Controller_Product extends Controller{

    function listProduct(){
        $data = $this->model->getList();
        $this->view->generate('product_list_view.php', 'template_view.php', $data);
    }

}