<?php

namespace Proyectos\Model;

use Librerias\EntityDbInterface;
use Librerias\AccesoDatos;
use Administracion\FacadeAdministracion;
use Proyectos\Entity\Proyecto;


class TipoProyectoAccesoDatos implements EntityDbInterface {

    //private static $ad;
    private static $repository = [];

    /* private function __construct() {
      $this->loadRepository();
      }

      public static function getIntance() {
      if (is_null(self::$ad)) {
      self::$ad = new TipoDocumentoAccesoDatos();
      }
      return self::$ad;
      } */

    public function loadRepository() {
        if (isset($_SESSION['repositorioTipoProyecto']))
            self::$repository = $_SESSION['repositorioTipoProyecto'];
        if (count(self::$repository) == 0) {

            $element = new TipoProyecto();
            $element->setId(1);
            $element->setNombre('curso');
            $element->setDescripcion('Descripcion ');
            self::$repository[] = $element;
            $element = new TipoProyecto();
            $element->setId(2);
            $element->setNombre('desarrollo');
            $element->setDescripcion('Descripcion ');
            self::$repository[] = $element;
            $element = new TipoProyecto();
            $element->setId(3);
            $element->setNombre('charla');
            $element->setDescripcion('Descripcion ');
            self::$repository[] = $element;

            $this->mergeRepository();
        }
    }

    public function actualizar($entidad) {
        $this->loadRepository();
        foreach (self::$repository as $element) {
            if ($element->getId() == $entidad->getId()) {
                $element = $entidad;
            }
        }
        return $entidad->id();
    }

    public function consultar($query, $parameters) {
        $this->loadRepository();
        try {
            $array = [];
            if (!is_null($parameters) && isset($parameters['LIMIT']) && isset($parameters['OFFSET'])) {
                for ($i = $parameters['OFFSET']; $i <= $parameters['LIMIT']; $i++) {
                    $array[] = self::$repository[$i];
                }
                return $array;
            }
            return self::$repository;
        } catch (Exception $ex) {
            //return self::$repository;
        }
    }

    public function eliminar($entidad) {
        $this->loadRepository();
        for ($i = 0; $i < count(self::$repository); $i++) {
            $element = self::$repository[$i];
            if ($element->getidI() == $entidad->getId())
                unset(self::$repository[$i]);
            return $i;
        }
    }

    public function insertar($entidad) {
        $this->loadRepository();
        self::$repository[] = $entidad;
        return $entidad->getId();
    }

    public function consultarNombre($nombre) {
        $this->loadRepository();
        foreach (self::$repository as $element) {
            if (strtolower($element->getNombre()) == strtolower($nombre)) {
                return $element;
            }
        }
        return null;
    }

    public function consultarPorId($id) {
        $this->loadRepository();
        foreach (self::$repository as $element) {
            if ($element->getId() == $id) {
                return $element;
            }
        }
        return null;
    }

    
    
     public function consultarTodos($parameters) {
        $this->loadRepository();
        return $this->consultar(null, null);
    }

    public function contarTodos($parameters) {
        $this->loadRepository();
        return count(self::$repository);
    }

    public function consultarActivos() {
        $this->loadRepository();
        return $this->consultar(null, null);
    }

    public function contar($parameters) {
        $this->loadRepository();
        return count(self::$repository);
    }

    private function mergeRepository() {
        $_SESSION['repositorioTipoProyecto'] = self::$repository;
    }

}