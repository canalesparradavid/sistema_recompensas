<?php

include_once "pages/LoginPage.php";
include_once "pages/MainPage.php";
include_once "pages/ProfilePage.php";
include_once "pages/RewardsPage.php";
include_once "pages/SignupPage.php";
include_once "pages/TasksPage.php";

// Cargo las plantillas de los elementos de la pagina web
$index_template = file_get_contents("templates/index.html");
$header_template = file_get_contents("templates/header.html");
$footer_template = file_get_contents("templates/footer.html");

$page_contents = $index_template;

// Sustituyo cada  elemento por la plantilla correspondiente
$page_contents = str_replace("<!-- HEADER -->", $header_template, $page_contents);
$page_contents = str_replace("<!-- FOOTER -->", $footer_template, $page_contents);

// Calculo la pagina que se debe mostrar
$page_name = isset($_GET['p'])? $_GET['p'] : 'main';
switch($page_name){
    case 'login':
        $page = new LoginPage();
        break;
    case 'signup':
        $page = new SignupPage();
        break;
    case 'tasks':
        $page = new TasksPage();
        break;
    case 'rewards':
        $page = new RewardsPage();
        break;
    case 'profile':
        $page = new ProfilePage();
        break;
     default:
        $page = new Mainpage();
}

// Sustituyo el contenido principal de la pagina
$page_contents = str_replace("<!-- BODY -->", $page->getContent(), $page_contents);

// Cargo el contenido en pantalla
echo $page_contents;

?>
