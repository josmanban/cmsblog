<?php
namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotAllParametersException
 *
 * @author jose
 */
class MissingParametersException extends \Exception {

    //put your code here
    //put your code here
    protected $parametros;

    public function __construct($parametros) {
        $this->parametros = $parametros;
        $message = "Faltan parámetros en la solicitud ";
        foreach ($parametros as $parametro) {
            $message = $message.', '.$parametro.' no encontrado';
        }
        $message=$message.'.';
        parent::__construct($message);
    }

}

?>
