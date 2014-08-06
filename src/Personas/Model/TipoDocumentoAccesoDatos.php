<?php

namespace Personas\Model;

use Librerias\EntityDbInterface;
use Librerias\AccesoDatos;

class TipoDocumentoAccesoDatos implements EntityDbInterface {

    //private static $ad;
    private static $repository = [];

    /* private function __construct() {
      $this->loadRepository();
      }

      public function getIntance() {
      if (is_null(self::$ad)) {
      self::$ad = new TipoDocumentoAccesoDatos();
      }
      return self::$ad;
      } */

    public function loadRepository() {
        if (count(self::$repository) == 0) {
            for ($i = 0; $i < 5; $i++) {
                $elemento = new TipoDocumento();
                $elemento->setId($i);
                $elemento->setNombre('TipoDocumento ' . $i);
                $elemento->setDescripcion('Descripcion ' . $i);
                self::$repository[] = $elemento;
            }
        }
    }

    public function actualizar($entidad) {
        $this->loadRepository();
        foreach (self::$repository as $elemento) {
            if ($elemento->getId() == $entidad->getId()) {
                $elemento = $entidad;
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
            $elemento = self::$repository[$i];
            if ($elemento->getidI() == $entidad->getId())
                unset(self::$repository[$i]);
            return $i;
        }
    }

    public function insertar($entidad) {
        $this->loadRepository();
        self::$repository[] = $entidad;
        return $entidad->getId();
    }

    public function consultarPorNombre() {
        $this->loadRepository();
        $this->consultar(null, null);
    }

    public function consultarPorId($id) {
        $this->loadRepository();
        foreach (self::$repository as $elemento) {
            if ($elemento->getId() == $id) {
                return $elemento;
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

    public function contar($parameters) {
        $this->loadRepository();
        return count(self::$repository);
    }

    public function consultarActivos() {
        $this->loadRepository();
        return $this->consultar(null, null);
    }

}