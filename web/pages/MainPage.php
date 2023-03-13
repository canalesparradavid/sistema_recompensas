<?php

include_once "Page.php";

class MainPage extends Page{
    protected function setRootDir() : string{
        return "./templates/main/";
    }

    public function getContent() : string{
        return "Main";
    }
}

?>
