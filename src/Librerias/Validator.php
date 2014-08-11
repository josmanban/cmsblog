<?php

namespace Librerias;

use Librerias\InvalidFormDataException;
use Librerias\InvalidDBActionException;
require_once dirname(__FILE__) . '/../../vendor/spekkionu/htmlpurifier/HTMLPurifier.auto.php';
//use JBBCode\Parser;
//use JBBCode\DefaultCodeDefinitionSet;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validator
 *
 * @author jose
 */
abstract class Validator {

    //put your code here
    //errores comunes referidos a datos de formularios
    protected $errores = [];
    protected $entity;

    //agrego error
    protected function addError($error) {
        if ($error)
            $this->errores[] = $error;
    }

    //controlo si hay errores
    protected function checkErrores() {
        if (count($this->errores) > 0) {
            throw new InvalidFormDataException($this->errores);
        }
    }

    //Validaciones que retoran excepcion
    abstract function validate();

    abstract protected function validateEmptyFields();

    abstract protected function validateSpecialFields();

    // Validaciones comunes de formulario, retornan mensaje
    // en caso de error o false en caso de todo OK, son juntadas en un arreglo de 
    // errores y el metodo checkErrores() lanzar InvalidDataFormException() en caso de
    // haber errores

    public function setEntity($entity) {
        $this->entity = $entity;
    }

    public static function validateEmail($email, $fieldName) {
        //return '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $fieldName . " inválido.";
        }
        return false;
    }

    public static function validateDateField($fecha, $fieldName) {
        //return '';
        if (empty($fecha))
            return $fieldName . " inválida.";
        if (!self::validateDate($fecha, 'd-m-Y'))
            return $fieldName . " inválida.";
        return false;
    }

    public static function validateEmptyField($field, $fieldName) {
        if (empty($field))
            return $fieldName . " es obligatorio.";
        return false;
    }

    public static function validateNullProperty($property, $propertyName) {
        if (is_null($property))
            return $propertyName . " es obligatorio.";
        return false;
    }

    //http://www.w3schools.com/php/php_file_upload.asp
    public static function validateImage($field, $fieldName, $size = 20000) {

        //http://www.w3schools.com/php/php_file_upload.asp
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES[$field]["name"]);
        $extension = end($temp);

        if ((($_FILES[$field]["type"] == "image/gif") ||
                ($_FILES[$field]["type"] == "image/jpeg") ||
                ($_FILES[$field]["type"] == "image/jpg") ||
                ($_FILES[$field]["type"] == "image/pjpeg") ||
                ($_FILES[$field]["type"] == "image/x-png") ||
                ($_FILES[$field]["type"] == "image/png")) &&
                ($_FILES[$field]["size"] < $size) && in_array($extension, $allowedExts)) {
            if ($_FILES[$field]["error"] > 0) {
                return 'Error al cargar la imagen.';
            }
        } else {
            //echo "Invalid file";
            return $fieldName . ' inválida.';
        }
        return false;
    }

    public static function validateRequiredField($fieldName, $displayName = '') {

        if (!isset($_REQUEST[$fieldName])) {
            if (empty($displayName))
                return ucfirst($fieldName) . ' es obligatorio.';
            else {
                return $displayName . ' es obligatorio.';
            }
        }
        return false;
    }

    public static function validatePasswordFormat($password) {
        /*
         * PHP PCRE - How to validate complex passwords using regular expressions
         */
        if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password))
            return 'Password invalido.';
        return false;
        /*
          Explaining $\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$
          $ = beginning of string
          \S* = any set of characters
          (?=\S{8,}) = of at least length 8
          (?=\S*[a-z]) = containing at least one lowercase letter
          (?=\S*[A-Z]) = and at least one uppercase letter
          (?=\S*[\d]) = and at least one number
          (?=\S*[\W]) = and at least a special character (non-word characters)
          $ = end of the string
         */
    }

    public static function validatePasswords($password, $passwordRepetir) {
        if (trim($password) != trim($passwordRepetir))
            return 'Las contrañas no coinciden';
        return false;
    }

    public static function validateInteger($field, $fieldName) {
        if (!is_numeric($field))
            return $fieldName . ' inválido.';
        return false;
    }

    public static function validateStringLength($string, $fieldName, $lengh = 100) {
        if (strlen($string) < $lengh)
            return ucfirst($fieldName) . ' debe superar los ' . $lengh . ' caracteres.';
        return false;
    }

    //http://www.php.net/manual/en/function.checkdate.php
    public static function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    
    public abstract function cleanFields();
    
    public static function clean($dirty_html) {

        /*
          $parser = new Parser();
          $parser->addCodeDefinitionSet(new DefaultCodeDefinitionSet());
          $parser->parse($bbcode);
          return $parser->getAsHtml(); */
        
        
        //$config = HTMLPurifier_Config::createDefault();
        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);
        //$clean_html = $purifier->purify($dirty_html);
        return $purifier->purify($dirty_html);
    }

}

?>
