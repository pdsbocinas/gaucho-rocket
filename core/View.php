<?php

class View
{
    private $path;

    function generate($content_view, $template_view, $data = null){
        $this->path = Path::getInstance("config/path.ini");
        require_once( $this->path->getPage("view", $template_view) );
    }
}