<?php

namespace SubsistemaArticulos;

use SubsistemaArticulos\Model\ArticuloAccesoDatos;
use SubsistemaArticulos\Model\ComentarioAccesoDatos;
use SubsistemaArticulos\Model\CategoriaArticuloAccesoDatos;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class FacadeSubsistemaArticulos {

    public static function getCategoriasArticulosActivas() {
        try {
            $accesoDatos = new CategoriaArticuloAccesoDatos();
            return $accesoDatos->consultarActivas();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getCategoriaPorId($id) {
        try {
            $accesoDatos = new CategoriaArticuloAccesoDatos();
            return $accesoDatos->consultarPorId($id);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

?>
