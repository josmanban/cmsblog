<?php
namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvalidFormDataException
 *
 * @author jose
 */
class InvalidFormDataException extends \Exception{
    //put your code here
    private $errores;
    function __construct($errores) {
        $this->errores=$errores;
        parent::__construct('Error en datos del formulario.');
    }

    public function getErrores() {
        return $this->errores;
    }
    
}

?>
