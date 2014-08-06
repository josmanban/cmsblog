<?php

//use Librerias\FrontController;

//require_once __DIR__ .'/vendor/autoload.php';
//require_once __DIR__ . '/config.php';
require_once __DIR__.'/bootstrap.php';

try {
    //$usuarioController = new UsuarioController();
    session_start();
    //ValidacionesVarias::my_session_start();
    $frontController = new Librerias\FrontController();
    $frontController->run();
} catch (Exception $ex) {
    echo $ex->getMessage();
}