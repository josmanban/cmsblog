<?php
namespace Librerias;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvalidDBActionException
 *
 * @author jose
 */
class InvalidDBActionException extends Exception{
    //put your code here
    protected $errores;
    public function __construct() {
        parent::__construct();        
    }

}

?>
