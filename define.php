<?php
require_once "database.php";
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
open_connection();
$ttt=get_term();
$local_term = null;
while ($term = mysqli_fetch_assoc($ttt)){
    global $local_term;
    $local_term = $term['term'];
}