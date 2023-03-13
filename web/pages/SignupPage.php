<?php

include_once "Page.php";

class SignupPage extends Page{
    protected function setRootDir() : string{
        return "./templates/singup/";
    }

    public function getContent() : string{
        return "Signup";
    }
}

?>
