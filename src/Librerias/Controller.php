<?php

namespace Librerias;

/* To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author jose
 */
//interface ControllerInterface {
//    
//  
//
//    //put your code here
//    function indexAction();
//
//    function newAction();
//
//    function createAction();
//
//    function editAction();
//
//    function updateAction();
//
//    function deleteAction();
//
//    function showAction();
//    
//    function validate();
//}

abstract class Controller {

    public abstract function indexAction();

    public abstract function newAction();

    public abstract function createAction();

    public abstract function editAction();

    public abstract function showAction();

    public abstract function bind($entity = null);

    public function isAjax() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            return true;
        return false;
    }

}
?>
