<?php

namespace Articulos\Model\Validator;

use Librerias\Validator;
use Librerias\InvalidFormDataException;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectoValidator
 *
 * @author jose
 */
class PostValidator extends Validator {

    function __construct($entity = null) {       
        $this->entity = $entity;
    }

    protected function validateEmptyFields() {
        /*         * **** valido campos vacios y requeridos********** */
        $this->addError(self::validateEmptyField($this->entity->getTitulo(), 'titulo'));
        $this->addError(self::validateEmptyField($this->entity->getTexto(), 'texto'));
        $this->checkErrores();
    }

    protected function validateSpecialFields() {
        if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != '')
            $this->addError(self::validateImage('imagen', 'imagen', 90000));
        $this->addError(self::validateStringLength($this->entity->getTexto(), 'texto'));    
        $this->checkErrores();
    }

    public function validate() {
        try {
            $this->validateEmptyFields();
            $this->validateSpecialFields();
        } catch (Exception $ex) {
            throw $ex;
        }
    }


//put your code here
}

?>
