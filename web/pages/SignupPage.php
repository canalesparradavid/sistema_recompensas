<?php

include_once "Page.php";

class SignupPage extends Page{
    public function __construct(){
        parent::__construct();

        if($this->user->isLoged())
            header("Location: ?p=main");
    }
    
    protected function setRootDir() : string{
        return "./templates/signup/";
    }

    public function getContent() : string{
        // Si hay POST y datos correctos vamos a Profile
        if(isset($_POST['email'])){
            $signup_state = $this->user->signup($_POST['nick'], $_POST['email'], $_POST['password']);
            if($signup_state == User::SignUpOK){
                header("Location: ?p=profile");
                exit(0);
            }
        }

        // Si no hay POST o Datos incorrectos cargamos la pagina
        $page_contents = file_get_contents($this->root_dir."page.html");

        // Cargo un mensaje de error si hay POST pero los datos incorrectos
        if(isset($_POST['email'])){
            $msg = "No se he podido realizar el login. ERROR: ";
            switch($signup_state){
                case User::SignUpBadPass:
                    $msg .= "Contraseña incorrecta";
                    break;
                case User::SignUpBadEmail:
                    $msg .= "Email ya registrado";
                    break;
                default:
                    $msg .= "Codigo de error ".$signup_state;
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
