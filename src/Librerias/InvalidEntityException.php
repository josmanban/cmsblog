<?php

namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvalidEntityException
 *
 * @author jose
 */
class InvalidEntityException extends \Exception {

    //put your code here
    protected $errores;

    public function __construct($errores) {
        $this->errores = $errores;
        parent::__construct('Entidad invalida.');
    }

    public function getErrores() {
        return $this->errores;
    }

}

?>
