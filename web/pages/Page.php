<?php

include_once  "./models/User.php";

abstract class Page{
    private $user;

    function __construct(){
        $this->user = User::restoreSession();
    }

    public function getContent(){ }
}

?>
