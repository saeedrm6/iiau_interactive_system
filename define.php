<?php
define('Site','http://localhost/cms');
class Title{
    private $title;

    public function __construct()
    {
        $this->title="";
    }

    public function set_title($input=""){
        $this->title=$input;
    }

    public function get_title(){
        return $this->title;
    }

}

$ss = new Title;
$local_term = 95961;