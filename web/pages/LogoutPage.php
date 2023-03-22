<?php

include_once "LoginPage.php";

class LogoutPage extends LoginPage{
    public function __construct(){
        parent::__construct();

        $this->user->logout();
    }
}

?>
