<?php

namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoAllowedException
 *
 * @author jose
 */
class NotAllowedException extends \Exception {

    //put your code here
    public function __construct() {        
        parent::__construct('No tienes permisos para esta accion.');
    }

}

?>
