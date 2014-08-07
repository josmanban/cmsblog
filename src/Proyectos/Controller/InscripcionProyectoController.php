<?php

namespace Proyectos\Controller;

use Librerias\Controller;
use Librerias\View;
use Librerias\Paginator;
use Librerias\Constantes;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\NotFoundEntityException;
use Librerias\InvalidEntityException;
use Librerias\InvalidFormDataException;
use Librerias\MissingParametersException;
use Librerias\Conexion;
use Administracion\Model\Estado;
use Administracion\Model\Rol;
use Administracion\Model\Usuario;
use Administracion\FacadeAdministracion;
use Proyectos\Model\Proyecto;
use Proyectos\Model\InscripcionProyecto;
use Proyectos\Validator\InscripcionProyectoValidator;


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectoController
 *
 * @author jose
 */
class InscripcionProyectoController extends Controller {

    private $em;
   
    function __construct() {
        $this->em= Conexion::getEntityManager();
    }

//put your code here
    public function createAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!$usuario->esAdministrador() && $usuario->esAdministradorProyecto() && !$usuario->esPublicadorProyecto())
                throw new NotAllowedException();

            $inscripcionProyecto = $this->validate();
            $this->inscripcionProyectoAccesoDatos->insertar($inscripcionProyecto);

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_NEW, array(
                    'mensajeExito' => array('Inscripcion registrada con éxito'),
                    'roles' => FacadeAdministracion::getRolesProyecto(),
                    'personas' => FacadePaquetePersonas::getPersonasActivas(),
                    'proyectos' => $this->proyectoAccesoDatos->consultarActivos(),
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(INSCRIPCION_PROYECTO_NEW, array(
                'roles' => FacadeAdministracion::getRolesProyecto(),
                'personas' => FacadePaquetePersonas::getPersonasActivas(),
                'proyectos' => $this->proyectoAccesoDatos->consultarActivos(),
                'estados' => FacadeAdministracion::getEstadosActivos(),
                'errores' => $ex->getErrores(),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function deleteAction() {
        
    }

    public function editAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!isset($_GET['id']))
                throw new MissingParametersException(['id']);
            $id = $_GET['id'];
            $inscripcionProyecto = $this->inscripcionProyectoAccesoDatos->consultarPorId($id);
            $proyecto = $inscripcionProyecto->getProyecto();
            if (is_null($inscripcionProyecto))
                throw new NotFoundEntityException('inscripcion');
            if (is_null($proyecto))
                throw new NotFoundEntityException('proyecto');
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorProyectos() &&
                    !($usuario->esPublicadorProyecto() && $proyecto->esAuthor($usuario)))
                throw new NotAllowedException();

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_EDIT, array(
                    'inscripcionProyecto' => $inscripcionProyecto,
                    'roles' => FacadeAdministracion::getRolesProyecto(),
                    'personas' => FacadePaquetePersonas::getPersonasActivas(),
                    'proyectos' => $this->proyectoAccesoDatos->consultarActivos(),
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function indexAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorProyecto())
                throw new NotAllowedException();

            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;

            $numItems = $this->inscripcionProyectoAccesoDatos->contarTodos(null);
            $parameters = [];
            $paginator = new Paginator('inscripcionProyecto', 'index', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $parameters);
            $parameters[] = ['offset' => $paginator->getOffset()];
            $parameters[] = ['limit' => $paginator->getLimit()];

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_INDEX, array(
                    'inscripcionesProyecto' => $this->inscripcionProyectoAccesoDatos->consultarTodos($parameters),
                    'paginator' => $paginator,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function newAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!$usuario->esAdministrador() && $usuario->esAdministradorProyecto() && !$usuario->esPublicadorProyecto())
                throw new NotAllowedException();
            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_NEW, array(
                    'roles' => FacadeAdministracion::getRolesProyecto(),
                    'personas' => FacadePaquetePersonas::getPersonasActivas(),
                    'proyectos' => $this->proyectoAccesoDatos->consultarActivos(),
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function showAction() {
        try {
            if (!isset($_SESSION['usuario']))
                throw new NotLoggedException();
            $usuario = $_SESSION['usuario'];
            if (!isset($_REQUEST['id']))
                throw new MissingParametersException(array('id'));
            $id = $_REQUEST['id'];
            $inscripcionProyecto = $this->inscripcionProyectoAccesoDatos->consultarPorId($id);
            if (is_null($inscripcionProyecto))
                throw new NotFoundEntityException('inscripcion proyecto');
            /*
             * No es administrador
             * No es administrador proyectos
             * No es el autor del proyecto
             * No la persona inscripta
             */
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorProyecto() &&
                    !($usuario->esPublicadorProyecto() && $inscripcionProyecto->getProyecto()->esAutor($usuario)) &&
                    !$inscripcionProyecto->getPersona->getUsuario()->getId() == $usuario->getId())
                throw new NotAllowedException();
            if (isset($_REQUEST['ajax'])) {
                
            }
            else
                View::render(INSCRIPCION_PROYECTO_SHOW, array(
                    'inscripcionProyecto' => $inscripcionProyecto,
                ));
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function archiveAction() {
        try {
            if (isset($_REQUEST['id']))
                $inscripcionesProyecto = $this->inscripcionProyectoAccesoDatos->consultarPorIdProyecto($_REQUEST['id']);
            else
                $inscripcionesProyecto = $this->inscripcionProyectoAccesoDatos->consultarTodos(null);

            if (isset($_REQUEST['ajax'])) {
                
            }
            else
                View::render(INSCRIPCION_PROYECTO_ARCHIVE, array(
                    'inscripcionesProyecto' => $inscripcionesProyecto,
                ));
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errorres' => array($ex->getMessage()),
            ));
        }
    }

    public function updateAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!isset($_POST['id']))
                throw new NotFoundEntityException();
            $id = $_POST['id'];
            $inscripcionProyecto = $this->inscripcionProyectoAccesoDatos->consultarPorId($id);
            $proyecto = $inscripcionProyecto->getProyecto();
            if (is_null($inscripcionProyecto))
                throw new NotFoundEntityException('inscripcion');
            if (is_null($proyecto))
                throw new NotFoundEntityException('proyecto');
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorProyectos() &&
                    !($usuario->esPublicadorProyecto() && $proyecto->esAuthor($usuario)))
                throw new NotAllowedException();
            $this->validate($inscripcionProyecto);
            $this->inscripcionProyectoAccesoDatos->actualizar($inscripcionProyecto);

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_EDIT, array(
                    'roles' => FacadeAdministracion::getRolesProyecto(),
                    'personas' => FacadePaquetePersonas::getPersonasActivas(),
                    'proyectos' => $this->proyectoAccesoDatos->consultarActivos(),
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                    'mensajesExito' => array('Datos actualizada con exito.'),
                    'inscripcionProyecto' => $inscripcionProyecto,
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(INSCRIPCION_PROYECTO_EDIT, array(
                'roles' => FacadeAdministracion::getRolesProyecto(),
                'personas' => FacadePaquetePersonas::getPersonasActivas(),
                'proyectos' => $this->proyectoAccesoDatos->consultarActivos(),
                'estados' => FacadeAdministracion::getEstadosActivos(),
                'errores' => $ex->getErrores(),
                'inscripcionProyecto' => $this->inscripcionProyectoAccesoDatos->consultarPorId($_POST['id']),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function bind($inscripcionProyecto = null) {
        try {
            if (is_null($inscripcionProyecto))
                $inscripcionProyecto = new InscripcionProyecto();

            $id = $_POST['id'];
            $descripcionActividad = isset($_POST['descripcionActividad']) ? $_POST['descripcionActividad'] : '';
            $idEstado = isset($_POST['estado']) ? $_POST['estado'] : -1;
            $idRolProyecto = isset($_POST['rol']) ? $_POST['rol'] : -1;
            //$idUsuario = isset($_POST['usuario']) ? $_POST['usuario'] : -1;
            $idPersona = isset($_POST['persona']) ? $_POST['persona'] : -1;
            $idProyecto = isset($_POST['proyecto']) ? $_POST['proyecto'] : -1;


            $rolProyecto = FacadeAdministracion::getRolProyectoPorId($idRolProyecto);
            //$usuario = FacadeAdministracion::getUsuarioPorId($idUsuario);
            $persona = FacadePaquetePersonas::getPersonaPorId($idPersona);
            $proyecto = $this->proyectoAccesoDatos->consultarPorId($idProyecto);
            $estado = FacadeAdministracion::getEstadoPorId($idEstado);

            $inscripcionProyecto->setId($id);
            $inscripcionProyecto->setProyecto($proyecto);
            if ($inscripcionProyecto->getId() == -1)
                $inscripcionProyecto->setFechaInscripcion(new \DateTime());
            $inscripcionProyecto->setEstado($estado);
            $inscripcionProyecto->setPersona($persona);
            $inscripcionProyecto->setRol($rolProyecto);
            $inscripcionProyecto->setDescripcionActividad($descripcionActividad);

            $validator = new InscripcionProyectoValidator($inscripcionProyecto);
            $validator->validate();

            return $inscripcionProyecto;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

?>
