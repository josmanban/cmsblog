<?php

namespace Administracion\Model\Validator;

use Librerias\Validator;
use Librerias\Conexion;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidatorUsuario
 *
 * @author jose
 */
class PerfilValidator extends Validator {

    //put your code here

    function __construct($entity = null) {
        $this->entity = $entity;        
    }

    public function validate() {
        try {
            $this->validateEmptyFields();
            $this->validateSpecialFields();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected function validateEmptyFields() { 
    }

    protected function validateSpecialFields() {   
        $this->addError($this->validateNullProperty($this->entity->getUsuario(), 'usuario'));        
        $this->checkErrores();
    }

  

}

?>