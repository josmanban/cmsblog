<?php

namespace Proyectos\Model\Validator;

use Articulos\Model\Validator\PostValidator;
use Librerias\Conexion;

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
        $this->entity = $entity;
    }

    protected function validateEmptyFields() {
        parent::validateEmptyFields();
        $this->addError(self::validateEmptyField($this->entity->getCodename(), 'codename'));
        $this->addError(self::validateEmptyField($this->entity->getFechaInicio(), 'Fecha inicio'));

        $this->checkErrores();
    }

    protected function validateSpecialFields() {
        $this->addError(self::validateDateField($this->entity->getFechaInicio(), 'Fecha inicio'));
        if ($this->entity->getCupo() != null)
            $this->addError(self::validateInteger($this->entity->getCupo(), 'cupo'));
        $this->addError(self::validateRepeatedCodeName($this->entity->getId(), $this->entity->getCodename(), 'codename'));
        $this->addError(parent::validateNullProperty($this->entity->getTipo(), 'tipo'));
        $this->checkErrores();

        /*         * *** paso el string a datetime object ****** */
        $this->entity->setFechaInicio(new \DateTime($this->entity->getFechaInicio()));
    }

    public static function validateRepeatedCodeName($id, $codename, $fieldname = 'codename') {
        $em = Conexion::getEntityManager();
        $proyecto = $em->getRepository('Proyectos\Model\Entity\Proyecto')->findOneBy(array(
            'codename' => $codename
        ));

        if (!is_null($proyecto) && $proyecto->getId() != $id)
            return ucfirst($fieldname) . ' ya registrado.';
        return false;
    }

//put your code here
}

?>
