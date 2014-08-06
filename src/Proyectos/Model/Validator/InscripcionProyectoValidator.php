<?php

namespace Proyectos\Validator;

use Librerias\Validator;
use Proyectos\Model\InscripcionProyectoAccesoDatos;
use Proyectos\Model\InscripcionProyecto;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscripcionProyectoValidator
 *
 * @author jose
 */
class InscripcionProyectoValidator extends Validator {

    function __construct($entity) {
        $this->accesoDatos = new InscripcionProyectoAccesoDatos();
        $this->entity = $entity;
    }

    //put your code here
    protected function validateEmptyFields() {
        
    }

    protected function validateSpecialFields() {
        $this->addError(parent::validateNullProperty($this->entity->getPersona(), 'persona'));
        $this->addError(parent::validateNullProperty($this->entity->getProyecto(), 'proyecto'));
        $this->addError(parent::validateNullProperty($this->entity->getEstado(), 'estado'));
        $this->addError(parent::validateNullProperty($this->entity->getRol(), 'rol'));
        $this->checkErrores();
        $this->addError($this->validateRepeatedInscripcionProyecto());
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

    public function validateRepeatedInscripcionProyecto() {
        $inscripcionProyecto = $this->accesoDatos->consultarPorIdProyectoIdPersona(
                $this->entity->getProyecto()->getId(), $this->entity->getPersona()->getId()
        );

        if (!is_null($inscripcionProyecto) && $inscripcionProyecto->getId() != $this->entity->getId()) {
            return 'Inscripci&oacute;n rechazada. La persona ya esta inscripta al proyecto.';
        }
        return false;
    }

}

?>
