<?php

namespace Proyectos\Validator;

use Librerias\Validator;
use Librerias\Conexion;
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
        $this->addError(self::validateRepeatedInscripcionProyecto($this->entity->getId(),
                $this->entity->getProyecto()->getId(),
                $this->entity->getPersona()->getId()));
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

    public static function validateRepeatedInscripcionProyecto($idInscripcion, $idProyecto, $idPersona) {
        
        $em = Conexion::getEntityManager();
        $inscripcionProyecto = $this->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->findOneBy(
                array(
                    'proyecto' => $idProyecto,
                    'persona' => $idPersona,
                ));

        if (!is_null($inscripcionProyecto) && $inscripcionProyecto->getId() != $idInscripcion) {
            return 'Inscripci&oacute;n rechazada. La persona ya esta inscripta al proyecto.';
        }
        return false;
    }

}

?>
