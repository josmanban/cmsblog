<?php

namespace Administracion;

use Administracion\Model\UsuarioAccesoDatos;
use Administracion\Model\EstadoAccesoDatos;
use Administracion\Controller\UsuarioController;
use Administracion\Model\RolAccesoDatos;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class FacadeAdministracion {

    public static function getUsuarioPorId($id) {
        try {
            $accesoDatosUsuario = new UsuarioAccesoDatos();
            return $accesoDatosUsuario->consultarPorId($id);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /*     * *Paginado* */

    public static function getUsuariosActivos() {
        try {
            $accesoDatosUsuario = new UsuarioAccesoDatos();
            return $accesoDatosUsuario->consultarActivos();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getTodosUsuariosActivos() {
        try {
            $accesoDatosUsuario = new UsuarioAccesoDatos();
            return $accesoDatosUsuario->consultarTodos();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getEstadoPorId($id) {
        try {
            $accesoDatosEstado = new EstadoAccesoDatos();
            return $accesoDatosEstado->consultarPorId($id);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getEstadoPorNombre($nombre) {
        try {
            $accesoDatosEstado = new EstadoAccesoDatos();
            return $accesoDatosEstado->consultarPorNombre($nombre);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getEstadosActivos() {
        try {
            $accesoDatosEstado = new EstadoAccesoDatos();
            return $accesoDatosEstado->consultarActivos();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getRolProyecto($nombreRol) {
        try {
            $accesoDatosEstado = new RolAccesoDatos();
            return $accesoDatosEstado->consultarPorNombreAmbito($nombreRol, 'Proyecto');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getRolProyectoPorId($id) {
        try {
            $accesoDatosEstado = new RolAccesoDatos();
            return $accesoDatosEstado->consultarPorIdAmbito($id, 'Proyecto');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getRolesProyecto() {
        try {
            $accesoDatosRol = new RolAccesoDatos();
            return $accesoDatosRol->consultarPorAmbito('Proyecto');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

?>
