<?php

namespace Librerias;

//include dirname(__FILE__) . '/FrontControllerInterface.php';

/*
 * autor sitepoint.
 * url http://www.sitepoint.com/front-controller-pattern-1/
 */
//use SubsistemaAdministracion\Controller;
//use SubsistemaArticulos\Controller;
use Librerias\ValidacionesVarias;

class FrontController implements FrontControllerInterface {

    //const DEFAULT_CONTROLLER = "SubsistemaArticulos\\Controller\\ArticuloController";
    const DEFAULT_CONTROLLER = "Paginas\\Controller\\PaginaController";
    const DEFAULT_ACTION = "portadaAction";

    protected $controller = self::DEFAULT_CONTROLLER;
    protected $action = self::DEFAULT_ACTION;
    //protected $params        = array();
    protected $basePath = "mybasepath/";

    public function __construct(array $options = array()) {
        $this->basePath = dirname(__FILE__) . "/../../";
        if (empty($options)) {
            $this->parseUri();
        } else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);
            }
            /* if (isset($options["params"])) {
              $this->setParams($options["params"]);
              } */
        }
    }

    protected function parseUri() {
        /* $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
          $path = preg_replace('/[^a-zA-Z0-9]//', "", $path);
          if (strpos($path, $this->basePath) === 0) {
          $path = substr($path, strlen($this->basePath));
          }

          @list($controller, $action, $params) = explode("/", $path, 3);
          if (isset($controller)) {
          $this->setController($controller);
          }
          if (isset($action)) {
          $this->setAction($action);
          }
          if (isset($params)) {
          $this->setParams(explode("/", $params));
          } */
        if (isset($_GET['controller'])) {
            $this->setController($_GET['controller']);
        }
        if (isset($_GET['action'])) {
            $this->setAction($_GET['action']);
        }
    }

    public function setController($controller) {
        $controller = ucfirst(strtolower($controller));
        /* if (!class_exists($controller)) {
          throw new \InvalidArgumentException(
          "The action controller '$controller' has not been defined.");
          } */
        try {
            $this->controller = ValidacionesVarias::rutaCompletaController($controller);
            return $this;
        } catch (Exception $e) {
            throw $ex;
        }
    }

    public function setAction($action) {
        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action . 'Action')) {
            throw new \InvalidArgumentException(
            "The controller action '$action' has been not defined.");
        }
        $this->action = $action . 'Action';
        return $this;
    }

    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }

    public function run() {
        // call_user_func_array(array(new $this->controller, $this->action), $this->params);
       // echo "Controlador: " . $this->controller . '<br>Action: ' . $this->action;
        $controller = new $this->controller();
        $executeAction = $this->action;
        $controller->$executeAction();
    }

}