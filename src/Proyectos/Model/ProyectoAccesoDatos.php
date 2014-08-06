<?php

namespace Proyectos\Model;

use Librerias\EntityDbInterface;
use Librerias\AccesoDatos;
use Administracion\FacadeAdministracion;
use Proyectos\Model\Proyecto;
use Articulos\Model\Articulo;
use Articulos\FacadeArticulos;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectoAccesoDatos
 *
 * @author jose
 */
class ProyectoAccesoDatos implements EntityDbInterface {

    private static $repository = [];

    public function loadRepository() {
        if (isset($_SESSION['repositorioProyecto']))
            self::$repository = $_SESSION['repositorioProyecto'];
        if (count(self::$repository) == 0) {

            $usuario = FacadeAdministracion::getUsuarioPorId(1);

            $estado = FacadeAdministracion::getEstadoPorNombre('activo');

            $tipoProyectoAccesoDatos = new TipoProyectoAccesoDatos();
            $charla = $tipoProyectoAccesoDatos->consultarNombre('charla');
            $desarrollo = $tipoProyectoAccesoDatos->consultarNombre('desarrollo');
            $curso = $tipoProyectoAccesoDatos->consultarNombre('curso');

            for ($i = 0; $i < 60; $i++) {
                if ($i < 20)
                    $tipo = $desarrollo;
                elseif ($i >= 20 && $i < 40)
                    $tipo = $curso;
                else {
                    $tipo = $charla;
                }
                /*                 * ********datos tipo base********* */
                $element = new Proyecto();
                $element->setId($i);
                $element->setEstado($estado);

                $element->setTexto('arcu. Phasellus vitae sem in quam lobortis rhoncus. Donec vel tempus massa, at convallis nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed eleifend dolor nunc, luctus laoreet est vestibulum eu. Aenean vestibulum congue nisl, eu sodales nibh pulvinar at. In laoreet nisl quis vehicula vulputate. Aenean et nisi felis. Phasellus tristique libero purus, quis bibendum tortor accumsan quis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam commodo enim at libero interdum lobortis. Nulla sed dictum risus.

Aenean egestas vehicula augue vel accumsan. Aliquam pharetra ornare metus vitae faucibus. Nunc ullamcorper sagittis nulla ut porttitor. Donec lectus diam, posuere porta tellus sed, rhoncus mollis nulla. Suspendisse rhoncus feugiat placerat. Mauris non aliquet lacus. Vestibulum lobortis tellus nisi. Fusce ac massa volutpat, tempor orci non, ultrices quam. Ut suscipit diam posuere elementum porttitor. Etiam consectetur fermentum ligula et aliquet. Vivamus rhoncus rhoncus convallis. Aliquam placerat mi eget felis porttitor lobortis. Suspendisse feugiat dui eget sollicitudin porttitor. Mauris ultrices sodales mauris, sed tempor tortor vestibulum at.');
                $element->setFechaHoraPublicacion(new \DateTime());
                $element->setImagen('http://www.snuevarepublica.com/wp-content/uploads/2014/04/mc3basical-670x495.jpg');
                $element->setAutor($usuario);
                $element->setTitulo($tipo->getNombre() . ' ' . $i);

                /*                 * **************Datos proyecto********** */
                $element->setTipo($tipo);
                $element->setCupo(30);
                $element->setFechaInicio(new \DateTime());
                $element->setDuracionMeses(6);
                $element->setCodename('C.O.D.N.A.M.E ' . $i);
                $element->setVersion('0.0.1');
                self::$repository[] = $element;
            }


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
            $element = self::$repository[$i];
            if ($element->getidI() == $entidad->getId()) {
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

    public function consultarNombre($nombre) {
        //$this->consultar(null, null);
        $this->loadRepository();
        foreach (self::$repository as $element) {
            if (strtoupper($element->getTitulo()) == strtoupper($nombre)) {
                return $element;
            }
        }
        return null;
    }

    public function consultarPorCodeName($codename) {
        $this->loadRepository();
        foreach (self::$repository as $element) {
            if (strtoupper($element->getCodename()) == strtoupper($codename)) {
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
        $array = array();
        if (isset($parameters['tipoProyecto'])) {
            foreach (self::$repository as $element) {
                if ($element->esTipo($parameters['tipoProyecto'])) {
                    $array[] = $element;
                }
            }
            return $array;
        }
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
        $_SESSION['repositorioProyecto'] = self::$repository;
    }

}

?>
