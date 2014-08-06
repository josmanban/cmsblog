<?php

namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
interface EntityDbInterface {

    function insertar($entidad);

    function eliminar($entidad);

    function actualizar($entidad);

    function consultar($query, $parameters);

    function contar($parameters);
}

?>
