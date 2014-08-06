<?php

namespace Personas\Model;

use Librerias\EntityDbInterface;
use Librerias\AccesoDatos;
use Personas\Model\Sexo;
use Personas\Model\TipoDocumento;
use Administracion\FacadeAdministracion;

class PersonaAccesoDatos implements EntityDbInterface {

    //put your code here
    private static $repository = [];

    public function loadRepository() {
        if (isset($_SESSION['repositorioPersona']))
            self::$repository = $_SESSION['repositorioPersona'];
        if (count(self::$repository) == 0) {
            $tipoDocumentoAccesoDatos = new TipoDocumentoAccesoDatos();

            $tipoDocumento = $tipoDocumentoAccesoDatos->consultarPorId(1);
            $estado = FacadeAdministracion::getEstadoPorNombre('activo');
            $usuarios = FacadeAdministracion::getUsuariosActivos();
            
            $sexoAccesoDatos= new SexoAccesoDatos();
            $sexo= $sexoAccesoDatos->consultarPorNombre('masculino');

            foreach ($usuarios as $usuario) {
                $i = $usuario->getId();
                $persona = new Persona();
                $persona->setId($i);
                $persona->setNombre('Nombre' . $i);
                $persona->setApellido('Apellido' . $i);
                $persona->setFechaNacimiento(new \DateTime());
                //$persona->setFoto('https://lh6.googleusercontent.com/-01gzVqTArx4/AAAAAAAAAAI/AAAAAAAAAAA/DE4mx1iBmYg/s32-c/photo.jpg');
                $persona->setLugarNacimiento('Lugar nacimiento ' . $i);
                $persona->setNumDocumento($i);
                $persona->setEstado($estado);
                $persona->setUsuario($usuario);
                $persona->setTipoDocumento($tipoDocumento);
                $persona->setSexo($sexo);
                self::$repository[] = $persona;
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

    public function consultarPorNombre($entidad) {
        //$this->consultar(null, null);
        $this->loadRepository();
        foreach (self::$repository as $persona) {
            if ($persona->getNombre() == $entidad->getNombre()) {
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

    public function consultarPersonaRepetida($numDocumento, TipoDocumento $tipoDocumento, Sexo $sexo) {
        $this->loadRepository();
        foreach (self::$repository as $elemento) {
            if ($elemento->getNumDocumento() == $numDocumento && $elemento->getTipoDocumento()->getId() == $tipoDocumento->getId() && $elemento->getSexo()->getId() == $sexo->getId())
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

    public function consultarUltimoId() {
        $this->loadRepository();
        $b = true;
        foreach (self::$repository as $persona) {
            if ($b == true) {
                $lastId = $persona->getId();
            } else {
                if ($lastId < $persona->getId())
                    $lastId = $persona->getId();
            }
        }
        return $lastId++;
    }

    private function mergeRepository() {
        $_SESSION['repositorioPersona'] = self::$repository;
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