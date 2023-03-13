<?php

include_once "Page.php";

class TasksPage extends Page{
    protected function setRootDir() : string{
        return "./templates/tasks/";
    }

    public function getContent() : string{
        return "Tasks";
    }
}

?>
