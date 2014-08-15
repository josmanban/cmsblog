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
class MensajeValidator extends Validator {

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
        $this->addError(self::validateEmptyField($this->entity->getAsunto(), 'asunto'));
        $this->addError(self::validateEmptyField($this->entity->getTexto(), 'mensaje'));
        $this->checkErrores();
    }

    protected function validateSpecialFields() {
        $this->addError($this->validateNullProperty($this->entity->getEmisor(), 'emisor'));
        $this->addError($this->validateNullProperty($this->entity->getReceptor(), 'receptor'));
        $this->addError($this->validateNullProperty($this->entity->getEstado(), 'estado'));
        $this->checkErrores();
    }

    public function cleanFields() {
        $this->entity->setAvatar(self::clean($this->entity->getAsunto()));
        $this->entity->getDescripcion(self::clean($this->entity->getTexto()));
    }

}

?>
