<?php

namespace Proyectos\Validator;

use Articulos\Validator\PostValidator;
use Proyectos\Model\ProyectoAccesoDatos;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectoValidator
 *
 * @author jose
 */
class ProyectoValidator extends PostValidator {

    function __construct($entity = null) {
        ;
        $this->accesoDatos = new PostAccesoDatos();
        $this->entity = $entity;
    }

    protected function validateEmptyFields() {
        parent::validateEmptyFields();
        $this->addError(self::validateEmptyField($this->entity->getCodename(), 'codename'));
        $this->addError(self::validateEmptyField($this->entity->getFechaInicio(), 'Fecha inicio'));

        $this->checkErrores();
    }

    protected function validateSpecialFields() {
        parent::validateSpecialFields();
        $this->addError(self::validateDateField($this->entity->getFechaInicio(), 'Fecha inicio'));
        if ($this->entity->getCupo != null)
            $this->addError(self::validateInteger($this->entity->getCupo(), 'cupo'));
        $this->addError($this->validateRepeatedCodeName('codename'));
        $this->addError(parent::validateNullProperty($this->entity->getTipo(), 'tipo'));
        $this->checkErrores();
    }

    protected function validateRepeatedCodeName($fieldname) {
        $proyecto = $this->accesoDatos->consultarPorCodeName($this->entity->getCondename());
        if (!is_null($proyecto) && $proyecto->getId() != $this->entity->getId())
            return ucfirst($fieldname) . ' ya registrado.';
        return false;
    }

//put your code here
}

?>
