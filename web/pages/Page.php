<?php

include_once  "./models/User.php";

abstract class Page{
    protected $user;
    protected $root_dir;
    private $generated_html;

    function __construct(){
        // Cargo la sesion del usuario y establezco la ruta por defecto de las plantillas
        $this->user = User::restoreSession();
        $this->root_dir = $this->setRootDir();

        // Creo el contenido de la pagina web
            // Cargo las plantillas de los elementos de la pagina web
            $index_template = file_get_contents("templates/index.html");
            $header_template = file_get_contents("templates/header.html");
            $common_css_styles_template = file_get_contents("templates/common_css_styles.html");
            $footer_template = file_get_contents("templates/footer.html");

            $page_contents = $index_template;

            // Sustituyo cada  elemento por la plantilla correspondiente
            $page_contents = str_replace("<!-- HEADER -->", $this->constructHeader($header_template), $page_contents);
            $page_contents = str_replace("<!-- COMMON-CSS-STYLES -->", $common_css_styles_template, $page_contents);
            $page_contents = str_replace("<!-- FOOTER -->", $footer_template, $page_contents);

            // Sustituyo el contenido principal de la pagina
            $page_contents = str_replace("<!-- CSS-STYLES -->", $this->getStylesContent(), $page_contents);
            $page_contents = str_replace("<!-- PRE-SCRIPTS -->", $this->getPreScriptsContent(), $page_contents);
            $page_contents = str_replace("<!-- BODY -->", $this->getContent(), $page_contents);
            $page_contents = str_replace("<!-- POST-SCRIPTS -->", $this->getPostScriptsContent(), $page_contents);

        $this->generated_html = $page_contents;
    }

    public function loadPage(){
        return $this->generated_html;
    }

    private function constructHeader($header_content){
        return $header_content;
    }

    private function getPreScriptsContent(){
        return file_get_contents($this->root_dir."pre_scripts.html");
    }

    private function getPostScriptsContent(){
        return file_get_contents($this->root_dir."post_scripts.html");
    }

    private function getStylesContent(){
        return file_get_contents($this->root_dir."styles.html");
    }

    abstract protected function getContent() : string;
    abstract protected function setRootDir() : string;
}

?>
