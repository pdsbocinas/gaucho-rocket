<?php

class Model_Product extends Model{
    public function getList(){
        $productList[] = "Producto1";
        $productList[] = "Producto2";
        return $productList;
    }
}