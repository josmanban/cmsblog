<?php

namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotFoundEntityException
 *
 * @author jose
 */
class NotFoundEntityException extends \Exception {

    //put your code here
    
    public function __construct($entidad='entidad') {
        parent::__construct( ucfirst($entidad). ' no encontrado.');
    }

}

?>
