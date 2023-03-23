<?php

include_once "Page.php";

class ProfilePage extends Page{
    public function __construct(){
        parent::__construct();

        if(!$this->user->isLoged()){
            header("Location: ?p=main");
        }
    }

    protected function setRootDir() : string{
        return "./templates/profile/";
    }

    public function getContent() : string{
        $page_content = file_get_contents($this->root_dir."page.html");

        // Cambio la informacion del perfil
        $page_content = str_replace("##NICKNAME##", $this->user->getNickName(), $page_content);
        $page_content = str_replace("##EMAIL##", $this->user->getEmail(), $page_content);
        $page_content = str_replace("##CP##", 0, $page_content);    // TODO
        $page_content = str_replace("##CR##", 0, $page_content);    // TODO

        // Relleno el resumen de puntos TODO Enlazar con BBDD
        $page_content_parts = explode("<!-- RESUMEN-PUNTOS -->", $page_content);
        $points_resume = '';
        for($i = 0; $i < 100; $i++){
            $points_resume .= str_replace("##NAME##", "Resumen " . $i, $page_content_parts[1]);
        }
        $page_content = $page_content_parts[0] . $points_resume . $page_content_parts[2];

        // Relleno los objetivos TODO Enlazar con BBDD
        $page_content_parts = explode("<!-- OBJETIVOS -->", $page_content);
        $points_resume = '';
        for($i = 0; $i < 100; $i++){
            $points_resume .= str_replace("##NAME##", "Objetivo " . $i, $page_content_parts[1]);
        }
        $page_content = $page_content_parts[0] . $points_resume . $page_content_parts[2];

        return $page_content;
    }
}

?>
