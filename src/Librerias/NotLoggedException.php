<?php

namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoLoggedException
 *
 * @author jose
 */
class NotLoggedException extends \Exception {

    public function __construct() {
        parent::__construct('Tienes que iniciar sesión para realizar esta acción.');
    }

}

?>
