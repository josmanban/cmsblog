<?php

namespace Articulos\Model\Validator;

use Articulos\Model\Validator\PostValidator;
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
class ArticuloValidator extends PostValidator {

    //put your code here

    function __construct($entity = null) {       
        $this->entity = $entity;
    }    

    protected function validateEmptyFields() {
        /*         * **** valido campos vacios y requeridos********** */
        parent::validateEmptyFields();
        $this->addError($this->validateEmptyCategories());
        $this->checkErrores();
    }  

    public function validateEmptyCategories($fieldName = 'categorias') {
        if (is_null($this->entity->getCategorias()) || count($this->entity->getCategorias()) == 0) {
            return ucfirst($fieldName) . ' son obligatorias.';
        }
        return false;
    }
    
    public function cleanFields() {
        parent::cleanFields();
    }

}

?>
