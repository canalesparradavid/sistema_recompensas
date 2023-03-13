<?php

include_once "Page.php";

class RewardsPage extends Page{
    protected function setRootDir() : string{
        return "./templates/rewards/";
    }

    public function getContent() : string{
        return "Rewards";
    }
}

?>
