<?php

namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ValidacionesVarias {

    public static function rutaCompletaController($controller) {
        $controller = ucfirst($controller);
        //Agregar aqui los namespaces para completar las rutas de los controladores 
        //en los distintos subsitemas
        /* $controladoresCompletamenteCalificados = [
          'Administracion\\Controller\\' . $controller . 'Controller',
          'Articulos\\Controller\\' . $controller . 'Controller',
          ];
          foreach ($controladoresCompletamenteCalificados as $controladorCompletamenteCalificado) {
          try {
          if (class_exists($controladorCompletamenteCalificado))
          return $controladorCompletamenteCalificado;
          } catch (\InvalidArgumentException $ex) {
          continue;
          }
          } */
        switch ($controller) {
            case 'Estado':
            case 'Rol':
            case 'Perfil':
            case 'Usuario':
                return 'Administracion\\Controller\\' . $controller . 'Controller';
            case 'Persona':
                return 'Personas\\Controller\\' . $controller . 'Controller';
            case 'Pagina':
                return 'Paginas\\Controller\\' . $controller . 'Controller';
            case 'CategoriaArticulo':
            case 'Comentario':
            case 'Articulo':
                return 'Articulos\\Controller\\' . $controller . 'Controller';
            case 'Proyecto':
            case 'TipoProyecto':
                return 'Proyectos\\Controller\\' . $controller . 'Controller';
            case 'Inscripcionproyecto':
                return 'Proyectos\\Controller\\InscripcionProyectoController';

            default :
                throw new \InvalidArgumentException("No existe controlador " . $controller);
        }
    }

    public static function my_session_start() {
        if (isset($_COOKIE['PHPSESSID'])) {
            $sessid = $_COOKIE['PHPSESSID'];
        } else if (isset($_GET['PHPSESSID'])) {
            $sessid = $_GET['PHPSESSID'];
        } else {
            session_start();
            return false;
        }

        if (!preg_match('/^[a-z0-9]{32}$/', $sessid)) {
            return false;
        }
        session_start();

        return true;
    }

}

?>
