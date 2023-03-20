<?php

include_once "Page.php";

class LoginPage extends Page{

    protected function setRootDir() : string{
        return "./templates/login/";
    }

    public function getContent() : string{

        // Si hay POST y datos correctos vamos a Profile
        if(isset($_POST['email'])){
            $login_state = $this->user->login($_POST['email'], $_POST['password']);
            if($login_state == User::LoginOK){
                header("Location: ?p=profile");
                exit(0);
            }
        }

        // Si no hay POST o Datos incorrectos cargamos la pagina
        $page_contents = file_get_contents($this->root_dir."page.html");

        // Cargo un mensaje de error si hay POST pero los datos incorrectos
        if(isset($_POST['email'])){
            $msg = "No se he podido realizar el login. ERROR: ";
            switch($login_state){
                case User::LoginBadPass:
                    $msg .= "Contraseña incorrecta";
                    break;
                case User::LoginBadEmail:
                    $msg .= "Email invalido";
                    break;
                default:
                    $msg .= "Codigo de error ".$login_state;
            }
            // Solo cargo la plantilla si ha habido una peticion POST
            $msg_html = file_get_contents($this->root_dir."msg.html");
            $msg_html = str_replace("<!-- MSG -->", $msg, $msg_html);
        }
        else{
            $msg_html = '';
        }

        $page_contents = str_replace("<!-- MSG -->", $msg_html, $page_contents);

        return $page_contents;
    }
}

?>
