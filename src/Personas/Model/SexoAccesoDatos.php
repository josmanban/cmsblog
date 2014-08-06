<?php

namespace Personas\Model;

use Librerias\EntityDbInterface;
use Librerias\AccesoDatos;

class SexoAccesoDatos implements EntityDbInterface {

    //put your code here
    private static $repository = [];

    public function loadRepository() {
        if (isset($_SESSION['repositorioSexo']))
            self::$repository = $_SESSION['repositorioSexo'];
        if (count(self::$repository) == 0) {

            $entidad = new Sexo();
            $entidad->setId(0);
            $entidad->setNombre('femenino');
            self::$repository[] = $entidad;

            $entidad = new Sexo();
            $entidad->setId(1);
            $entidad->setNombre('masculino');
            self::$repository[] = $entidad;

            $entidad = new Sexo();
            $entidad->setId(2);
            $entidad->setNombre('transexual');

            self::$repository[] = $entidad;

            $this->mergeRepository();
        }
    }

    public function actualizar($entidad) {
        $this->loadRepository();
        for ($i = 0; $i < count(self::$repository); $i++) {
            if (self::$repository[$i]->getId() == $entidad->getId())
                self::$repository[$i] = $entidad;
        }
        $this->mergeRepository();

        return $entidad->getId();
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
            $persona = self::$repository[$i];
            if ($persona->getidI() == $entidad->getId()) {
                unset(self::$repository[$i]);
                $this->mergeRepository();

                return $i;
            }
        }
    }

    public function insertar($entidad) {
        $this->loadRepository();
        $entidad->setId(count(self::$repository) + 1);
        self::$repository[] = $entidad;
        $this->mergeRepository();
        return $entidad->getId();
    }

    public function consultarPorNombre($nombre) {
        //$this->consultar(null, null);
        $this->loadRepository();
        foreach (self::$repository as $persona) {
            if (strtoupper($persona->getNombre()) == strtoupper($nombre)) {
                return $persona;
            }
        }
        return null;
    }

    public function consultarPorIdUsuario($idUsuario) {
        $this->loadRepository();
        foreach (self::$repository as $elemento) {
            if ($elemento->getUsuario() != null && $elemento->getUsuario()->getId() == $idUsuario)
                return $elemento;
        }
        return null;
    }

    public function consultarPorId($id) {
        $this->loadRepository();
        foreach (self::$repository as $persona) {
            if ($persona->getId() == $id) {
                return $persona;
            }
        }
        return null;
    }

    private function mergeRepository() {
        $_SESSION['repositorioSexo'] = self::$repository;
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

}