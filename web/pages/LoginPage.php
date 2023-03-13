<?php

include_once "Page.php";

class LoginPage extends Page{

    protected function setRootDir() : string{
        return "./templates/login/";
    }

    public function getContent() : string{

        // Si hay POST y datos correctos vamos a Profile
        if(isset($_POST['email'])){
            if($this->user->login($_POST['email'], $_POST['password'])){
                header("Location: ?p=profile");
                exit(0);
            }
        }

        // Si no hay POST cargamos la pagina
        $page_contents = file_get_contents($this->root_dir."page.html");

        // Sustituyo los elementos de la pagina
        // $page_contents = str_replace()

        return $page_contents;
    }
}

?>
