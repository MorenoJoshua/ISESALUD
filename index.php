<?php
require_once 'Salud.php';
$salud = new Salud();

//var_dump($_REQUEST);

//$_SESSION['correo'] = 'j@morenojoshua.com';

//var_dump($_SESSION);

//unset($_SESSION);
//session_destroy();

if (!isset($_SESSION['email'])) {
    $salud->vista('templates/header');
    $salud->vista('templates/login');
    $salud->vista('templates/footer');
} else {
    if (!isset(array_keys($_REQUEST)[0])) {
        $vista = 'landing';
    } else {
        $vista = array_keys($_REQUEST)[0];
    }
    $GLOBALS['vistaActiva'] = $vista;
    $salud->vista('templates/header');
    $salud->vista($vista);
    $salud->vista('templates/footer');

}