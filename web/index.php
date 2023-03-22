<?php

include_once "models/DB.php";
include_once "pages/LoginPage.php";
include_once "pages/MainPage.php";
include_once "pages/ProfilePage.php";
include_once "pages/RewardsPage.php";
include_once "pages/SignupPage.php";
include_once "pages/TasksPage.php";

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
        $page = new MainPage();
}

// Cargo el contenido en pantalla
echo $page_contents;

?>
