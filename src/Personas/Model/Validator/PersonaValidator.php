<?php

namespace Personas\Model\Validator;

use Librerias\Validator;
use Librerias\InvalidFormDataException;


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidatorPersona
 *
 * @author jose
 */
class PersonaValidator extends Validator {

    //put your code here

    function __construct($entity = null) {
        $this->accesoDatos = new PersonaAccesoDatos();
        $this->entity = $entity;
    }

    public function validate() {
        try {
            $this->validateEmptyFields();
            $this->validateSpecialFields();
            $this->checkErrores();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected function validateEmptyFields() {
        /*         * **** valido campos vacios y requeridos********** */

        $this->addError(self::validateEmptyField($this->entity->getNombre(), 'nombre'));
        $this->addError(self::validateEmptyField($this->entity->getApellido(), 'apellido'));
        $this->addError(self::validateEmptyField($this->entity->getFechaNacimiento(), 'Fecha de nacimiento'));
        $this->addError(self::validateEmptyField($this->entity->getLugarNacimiento(), 'Lugar de nacimiento'));
        $this->addError(self::validateEmptyField($this->entity->getLugarNacimiento(), 'Nº documento'));
        $this->checkErrores();
    }

    protected function validateSpecialFields() {
        $this->addError(self::validateDateField($this->entity->getFechaNacimiento(), 'Fecha de nacimiento'));
        $this->addError(self::validateInteger($this->entity->getNumDocumento(), 'Número documento'));
        if (isset($_FILES['foto']) && $_FILES['foto']['name'] != '')
            $this->addError(self::validateImage('foto', 'foto'));

        $this->addError(self::validateNullProperty($this->entity->getUsuario(), 'usuario'));
        $this->addError(self::validateNullProperty($this->entity->getTipoDocumento(), 'tipo documento'));
        $this->addError(self::validateNullProperty($this->entity->getEstado(), 'estado'));
        $this->addError(self::validateNullProperty($this->entity->getSexo(), 'sexo'));
        $this->checkErrores();

        $this->addError($this->validateRepeatedPerson());
        $this->addError($this->validateAvailableUser());
        
        $this->checkErrores();

        /*         * *** paso el string a datetime object ****** */
        $this->entity->setFechaNacimiento(new \DateTime($this->entity->getFechaNacimiento()));
    }

    public static function validateRepeatedPerson($idPersona,$numDocumento,$idTipoDocumento,$idSexo,$fieldName = 'persona') {
        
        $em=  \Librerias\Conexion::getEntityManager();
        $persona= $em->getRepository('Persona\Model\Entity\Persona')->findOneBy(
                array('numDocumento'=>$numDocumento,
                    'tipoDocumento'=>$idTipoDocumento,
                    'sexo'=>$idSexo
                    )
                );
        
        if (!is_null($persona) && $persona->getId() != $idPersona) {
            return ucfirst($fieldName) . ' ya registrada.';
        }
        return false;
    }

    public static function validateAvailableUser($idPersona,$idUsuario,$fieldName = 'usuario') {
        $em=  \Librerias\Conexion::getEntityManager();
         $persona= $em->getRepository('Persona\Model\Entity\Persona')->findOneBy(
                array(
                    'usuario'=>$idUsuario
                    )
                );
        if (!is_null($persona) && $persona->getId() != $idPersona()) {
            return ucfirst($fieldName) . ' ya tiene una persona asignada.';
        }
        return false;
    }

}

?>
