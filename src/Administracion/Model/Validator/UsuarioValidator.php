<?php

namespace Administracion\Model\Validator;

use Administracion\Model\Business\AdministracionBusiness;
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
class UsuarioValidator extends Validator {

    //put your code here

    function __construct($entity = null) {
        $this->entity = $entity;
        $this->business = new AdministracionBusiness();
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
        $this->addError(self::validateEmptyField($this->entity->getNombre(), 'nombre'));
        $this->addError(self::validateEmptyField($this->entity->getEmail(), 'email'));

        if ($this->entity->getId() == null || !empty($this->entity->getPassword())) {
            $this->addError(self::validateEmptyField($this->entity->getPassword(), 'password'));
        }
        $this->checkErrores();
    }

    protected function validateSpecialFields() {
        if (!empty($this->entity->getPassword())){
            $this->addError(self::validatePasswordFormat($this->entity->getPassword()));
            if (isset($_REQUEST['repetirPassword']))
                $this->addError(self::validatePasswords($this->entity->getPassword(), $_REQUEST['repetirPassword']));
        }
        
		$this->validateEmail($this->entity->getEmail(), 'email');
        $this->addError($this->validateRepeatedName());
        $this->addError($this->validateRepeatedEmail());

        $this->checkErrores();

        //validar perfil cuando lo implemente
        $this->addError($this->validateNullProperty($this->entity->getRoles(), 'roles'));
        $this->addError($this->validateNullProperty($this->entity->getEstado(), 'estado'));
        $this->checkErrores();
    }

    public function validateRepeatedEmail($fieldName = 'email') {
        $usuario = $this->business->getUsuarioByEmail($this->entity->getEmail());
        if ($usuario && $usuario->getId() != $this->entity->getId())
            return ucfirst($fieldName) . ' ya registrado.';
        return false;
    }

    public function validateRepeatedName($fieldName = 'nombre') {
        $usuario = $this->business->getUsuarioByNombre($this->entity->getNombre());
        if ($usuario && $usuario->getId() != $this->entity->getId())
            return ucfirst($fieldName) . ' ya registrado.';
        return false;
    }

}

?>
