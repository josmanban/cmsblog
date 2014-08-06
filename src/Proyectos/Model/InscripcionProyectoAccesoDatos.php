<?php

namespace Proyectos\Model;

use Librerias\EntityDbInterface;
use Librerias\AccesoDatos;
use Administracion\FacadeAdministracion;
use Proyectos\Model\Proyecto;
use PaquetePersonas\FacadePaquetePersonas;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscripcionProyectoAccesoDatos
 *
 * @author jose
 */
class InscripcionProyectoAccesoDatos implements EntityDbInterface {

    private static $repository = [];

    public function loadRepository() {
        if (isset($_SESSION['repositorioInscripcionProyecto']))
            self::$repository = $_SESSION['repositorioInscripcionProyecto'];
        if (count(self::$repository) == 0) {

            $estadoActivo = FacadeAdministracion::getEstadoPorNombre('activo');

            $roles = array(
                /*                 * *******roles desarrollo******** */
                FacadeAdministracion::getRolProyecto('project manager'),
                FacadeAdministracion::getRolProyecto('maquetador'),
                FacadeAdministracion::getRolProyecto('desarrollador'),
                /*                 * *****roles charla********** */
                FacadeAdministracion::getRolProyecto('exponente'),
                FacadeAdministracion::getRolProyecto('participante'),
                /*                 * ****roles curso******** */
                FacadeAdministracion::getRolProyecto('profesor'),
                FacadeAdministracion::getRolProyecto('asistente'),
                FacadeAdministracion::getRolProyecto('alumno'),
            );

            $descripcionActividad = "descripcion actividad de ejemplo";

            $proyectoAccesoDatos = new ProyectoAccesoDatos();
            $proyectos = $proyectoAccesoDatos->consultarActivos();

            $fechaInscripcion = new \DateTime();

            $personas = FacadePaquetePersonas::getPersonasActivas();

            $i = 0;
            foreach ($proyectos as $proyecto) {
                foreach ($personas as $persona) {
                    $element = new InscripcionProyecto();
                    $element->setId($i);
                    $element->setPersona($persona);
                    $element->setProyecto($proyecto);
                    $element->setEstado($estadoActivo);
                    $element->setDescripcionActividad($descripcionActividad);
                    $element->setFechaInscripcion($fechaInscripcion);
                    if ($proyecto->esDesarrollo())
                        $rol = $roles[rand(0, 2)];
                    if ($proyecto->esCharla())
                        $rol = $roles[rand(3, 4)];
                    if ($proyecto->esCurso())
                        $rol = $roles[rand(5, 7)];
                    $element->setRol($rol);
                    self::$repository[] = $element;
                    $i++;
                }
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
            if (strtoupper($element->getNombre()) == strtoupper($nombre)) {
                return $element;
            }
        }
        return null;
    }

    public function consultarPorIdProyectoIdUsuario($idProyecto = -1, $idUsuario = -1) {
        $this->loadRepository();
        if ($idProyecto == -1 || $idUsuario == -1)
            return null;
        foreach (self::$repository as $element) {
            if ($element->getProyecto()->getId() == $idProyecto &&
                    $element->getPersona()->getUsuario()->getId() == $idUsuario) {
                return $element;
            }
        }
        return null;
    }

    public function consultarPorIdProyectoIdPersona($idProyecto = -1, $idPersona = -1) {
        $this->loadRepository();
        if ($idProyecto == -1 || $idPersona == -1)
            return null;
        foreach (self::$repository as $element) {
            if ($element->getProyecto()->getId() == $idProyecto &&
                    $element->getPersona->getId() == $idPersona) {
                return $element;
            }
        }
        return null;
    }

    public function consultarPorIdProyecto($idProyecto = -1) {
        $this->loadRepository();
        $array = array();
        if ($idProyecto == -1)
            return $array;
        foreach (self::$repository as $element) {
            if ($element->getProyecto()->getId() == $idProyecto) {
                $array[] = $element;
            }
        }
        return $array;
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
        $_SESSION['repositorioInscripcionProyecto'] = self::$repository;
    }

}

?>
