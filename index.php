<?php

//require_once __DIR__ .'/vendor/autoload.php';
//require_once __DIR__ . '/config.php';
require_once __DIR__ . '/bootstrap.php';

use Librerias\Conexion;

try {
    //$usuarioController = new UsuarioController();
    session_start();
    //ValidacionesVarias::my_session_start();
    if (isset($_SESSION['usuario'])) { //&& $_SESSION['usuario'] instanceof Usuario) {
        $em = Librerias\Conexion::getEntityManager();
        $usuario = $_SESSION['usuario'];
        $usuario = $em->getRepository('Administracion\Model\Entity\Usuario')->find($usuario->getId());
        $usuario = $em->merge($usuario);
        $_SESSION['usuario'] = $usuario;
    }
    $frontController = new Librerias\FrontController();
    $frontController->run();
} catch (Exception $ex) {
    echo $ex->getMessage();
} 
