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
        $this->em = Conexion::getEntityManager();
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
            $inscripcionProyecto->getProyecto()->addInscripcionProyecto($inscripcionProyecto);
            $this->em->persist($inscripcionProyecto);
            $this->em->flush();

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_NEW, array(
                    'mensajeExito' => array('Inscripcion registrada con éxito'),
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findActivos(),
                    'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                    'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(INSCRIPCION_PROYECTO_NEW, array(
                'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findActivos(),
                'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
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

            $inscripcionProyecto = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->find($id);
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
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findActivos(),
                    'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                    'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
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

            $numItems = $this->em->contarTodos(null);
            $criteria = [];
            $paginator = new Paginator('articulo', 'index', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $criteria);

            $inscripcionesProyecto = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->findBy(
                    $criteria, array('id' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
            );

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_INDEX, array(
                    'inscripcionesProyecto' => $inscripcionesProyecto,
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
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findActivos(),
                    'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                    'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
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
            $inscripcionProyecto = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')
                    ->find($id);
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
                $inscripcionesProyecto = $this->em->getRepository('Proyecto\Model\Entity\InscripcionProyecto')->findBy(
                        array('proyecto' => $_REQUEST['id']));
            else
                $inscripcionesProyecto = $this->em->getRepository('Proyecto\Model\Entity\InscripcionProyecto')->findAll();

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
            $inscripcionProyecto = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->find($id);
            $proyecto = $inscripcionProyecto->getProyecto();
            if (is_null($inscripcionProyecto))
                throw new NotFoundEntityException('inscripcion');
            if (is_null($proyecto))
                throw new NotFoundEntityException('proyecto');
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorProyectos() &&
                    !($usuario->esPublicadorProyecto() && $proyecto->esAuthor($usuario)))
                throw new NotAllowedException();


            $this->validate($inscripcionProyecto);
            $this->persist($inscripcionProyecto);
            $this->flush();

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_EDIT, array(
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findActivos(),
                    'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                    'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                    'mensajesExito' => array('Datos actualizada con exito.'),
                    'inscripcionProyecto' => $inscripcionProyecto,
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(INSCRIPCION_PROYECTO_EDIT, array(
                'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findActivos(),
                'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                'errores' => $ex->getErrores(),
                'inscripcionProyecto' => $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->find($_POST['id']),
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


            $rolProyecto = $this->em->getRepository('Administracion\Model\Entity\Rol')->find($idRolProyecto);
            $persona = $this->em->getRepository('Personas\Model\Entity\Persona')->find($idPersona);
            $proyecto = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->find($idProyecto);
            $estado = $this->em->getRepository('Administracion\Model\Entity\Estado')->find($idEstado);

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
