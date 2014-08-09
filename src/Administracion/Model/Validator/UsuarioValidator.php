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
class UsuarioValidator extends Validator {

    //put your code here

    private $repetirPassword;
    private $password;

    function __construct($entity = null, $password = "", $repetirPassword = "") {
        $this->entity = $entity;      
        $this->password = $password;
        $this->repetirPassword = $repetirPassword;
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

        if (is_null($this->entity->getId()) || !empty($this->password)) {
            $this->addError(self::validateEmptyField($this->password, 'password'));
            $this->addError(self::validateEmptyField($this->repetirPassword, 'password repetido'));
        }
        $this->checkErrores();
    }

    protected function validateSpecialFields() {
        if (!empty($this->password)) {
            $this->addError(self::validatePasswordFormat($this->password));
            $this->addError(self::validatePasswords($this->password, $this->repetirPassword));
        }
        Validator::validateEmail($this->entity->getEmail(), 'email');
        $this->addError(self::validateRepeatedName(
                        $this->entity->getId(), $this->entity->getNombre()));
        $this->addError(self::validateRepeatedEmail($this->entity->getId(), $this->entity->getEmail()
        ));

        $this->checkErrores();

        //validar perfil cuando lo implemente
        $this->addError($this->validateNullProperty($this->entity->getRoles(), 'roles'));
        $this->addError($this->validateNullProperty($this->entity->getEstado(), 'estado'));
        $this->checkErrores();
    }

    public static function validateRepeatedEmail($idUsuario, $email, $fieldName = 'email') {
        $em = Conexion::getEntityManager();
        $usuario = $em->getRepository('Administracion\Model\Entity\Usuario')
                ->findOneBy(array('email' => $email));
        if ($usuario && $usuario->getId() != $idUsuario)
            return ucfirst($fieldName) . ' ya registrado.';
        return false;
    }

    public static function validateRepeatedName($idUsuario, $nombre, $fieldName = 'nombre') {
        $em = Conexion::getEntityManager();
        $usuario = $em->getRepository('Administracion\Model\Entity\Usuario')
                ->findOneBy(array('nombre' => $nombre));
        if ($usuario && $usuario->getId() != $idUsuario)
            return ucfirst($fieldName) . ' ya registrado.';
        return false;
    }

}

?>
