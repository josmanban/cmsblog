<?php
namespace Librerias;

/*
 * autor sitepoint.com
 * url http://www.sitepoint.com/front-controller-pattern-1/
 */

interface FrontControllerInterface {

    public function setController($controller);

    public function setAction($action);

    public function setParams(array $params);

    public function run();
}