<?php

include_once  "./models/User.php";

abstract class Page{
    protected $user;
    protected $root_dir;

    function __construct(){
        $this->user = User::restoreSession();
        $this->root_dir = $this->setRootDir();
    }

    public function getPreScriptsContent(){
        return file_get_contents($this->root_dir."pre_scripts.html");
    }

    public function getPostScriptsContent(){
        return file_get_contents($this->root_dir."post_scripts.html");
    }

    public function getStylesContent(){
        return file_get_contents($this->root_dir."styles.html");
    }

    abstract public function getContent() : string;
    abstract protected function setRootDir() : string;
}

?>
