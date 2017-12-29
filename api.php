<?php
require_once 'Salud.php';

$fn = isset($_POST['fn']) ? $_POST['fn'] : $_GET['fn'];
$saludApi = new Salud();
$saludApi->$fn();