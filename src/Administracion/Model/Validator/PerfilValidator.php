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
            $this->cleanFields();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected function validateEmptyFields() {
        if (isset($_FILES['avatar']) && $_FILES['avatar']['name'] != '')
            $this->addError(self::validateImage('avatar', 'asvatar', 200000));
        $this->checkErrores();
    }

    protected function validateSpecialFields() {
        $this->addError($this->validateNullProperty($this->entity->getUsuario(), 'usuario'));
        $this->checkErrores();
    }

    public function cleanFields() {
        $this->entity->setAvatar(self::clean($this->entity->getAvatar()));
        $this->entity->getDescripcion(self::clean($this->entity->getDescripcion()));
    }

}

?>
