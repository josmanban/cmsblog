<?php

namespace Articulos\Model\Validator;

use Librerias\Validator;
use Librerias\InvalidEntityException;
use Librerias\InvalidFormDataException;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidatorUsuario
 *
 * @author jose
 */
class ComentarioValidator extends Validator {

    //put your code here

    function __construct($entity = null) {
        $this->entity = $entity;
        
    }

    public function validate() {
        try {
            $this->validateEmptyFields();
            $this->validateSpecialFields();
            $this->cleanFields();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected function validateEmptyFields() {
        $this->addError(self::validateEmptyField($this->entity->getTexto(), 'texto'));
        $this->checkErrores();
    }

    protected function validateSpecialFields() {
        $this->addError(self::validateStringLength($this->entity->getTexto(), 'texto', 4));
    }

    public function cleanFields() {
        $this->entity->setTexto(self::clean($this->entity->getTexto()));
    }

}

?>
