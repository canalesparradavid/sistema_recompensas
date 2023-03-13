<?php

include_once "Page.php";

class ProfilePage extends Page{
    protected function setRootDir() : string{
        return "./templates/profile/";
    }

    public function getContent() : string{
        return "Profile";
    }
}

?>
