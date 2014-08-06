<?php

namespace PaquetePersonas;

use PaquetePersonas\Model\PersonaAccesoDatos;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacadePaquetePersonas
 *
 * @author jose
 */
class FacadePaquetePersonas {

    //put your code here



    public static function getPersonaPorId($id) {
        try {
            if (is_null($id))
                return null;
            $personaAccesoDatos = new PersonaAccesoDatos();
            return $personaAccesoDatos->consultarPorId($id);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getPersonasActivas() {
        try {
            $personaAccesoDatos = new PersonaAccesoDatos();
            return $personaAccesoDatos->consultarActivos();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

?>
