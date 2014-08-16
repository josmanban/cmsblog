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
use Administracion\Model\Entity\Estado;
use Administracion\Model\Entity\Rol;
use Administracion\Model\Entity\Usuario;
use Proyectos\Model\Entity\Proyecto;
use Proyectos\Model\Entity\InscripcionProyecto;
use Proyectos\Model\Validator\InscripcionProyectoValidator;

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

            $inscripcionProyecto = $this->bind();
            $inscripcionProyecto->getProyecto()->addInscripcionProyecto($inscripcionProyecto);
            $this->em->persist($inscripcionProyecto);
            $this->em->flush();

            if ($this->isAjax()) {
                echo json_encode(array(
                    'mensaje' => 'Inscripción registrada con exito'
                ));
                die();
            } else {
                View::render(INSCRIPCION_PROYECTO_NEW, array(
                    'mensajeExito' => array('Inscripcion registrada con éxito'),
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findBy(array('ambito' => 'proyecto')),
                    'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                    'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findBy(array('ambito' => 'INSCRIPCIONPROYECTO')),
                ));
            }
        } catch (InvalidFormDataException $ex) {
            if ($this->isAjax()) {
                echo json_encode(array('errores' => $ex->getErrores()));
                die();
            }
            View::render(INSCRIPCION_PROYECTO_NEW, array(
                'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findBy(array('ambito' => 'proyecto')),
                'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findBy(array('ambito' => 'INSCRIPCIONPROYECTO')),
                'errores' => $ex->getErrores(),
            ));
        } catch (\Exception $ex) {
            if ($this->isAjax()) {
                echo json_encode(array(
                    'errores' => array(
                        $ex->getMessage()
                )));
                die();
            }
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

            if ($this->isAjax()) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_EDIT, array(
                    'inscripcionProyecto' => $inscripcionProyecto,
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findBy(array('ambito' => 'proyecto')),
                    'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                    'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findBy(array('ambito' => 'INSCRIPCIONPROYECTO')),
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


            $criteria = [];
            $numItems = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->contar($criteria);
            $paginator = new Paginator('articulo', 'index', $page, ITEMS_X_PAGE_INDEX, $numItems, $criteria);

            $inscripcionesProyecto = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->findBy(
                    $criteria, array('id' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
            );

            if ($this->isAjax()) {
                
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

    public function misInscripcionesAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (is_null($usuario->getPersona()))
                throw new \Exception('Completa tus datos personales.');

            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;


            $criteria = ['persona' => $usuario->getPersona()->getId()];
            $numItems = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->contar($criteria);
            $paginator = new Paginator('inscripcionProyecto', 'misInscripciones', $page, ITEMS_X_PAGE_INDEX, $numItems, $criteria);

            $inscripcionesProyecto = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->findBy(
                    $criteria, array('fechaInscripcion' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
            );

            if ($this->isAjax()) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_MIS_INSCRIPCIONES, array(
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
            if ($this->isAjax()) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_NEW, array(
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findBy(array('ambito' => 'proyecto')),
                    'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                    'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findBy(array('ambito' => 'INSCRIPCIONPROYECTO')),
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
            if ($this->isAjax()) {
                
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

            $estado = $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array(
                'nombre' => 'aceptado',
                'ambito' => 'INSCRIPCIONPROYECTO'
            ));

            $proyecto = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->find($_GET['id']);

            if (!is_null($proyecto)) {
                $inscripcionesProyecto = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->findBy(
                        array('proyecto' => $proyecto->getId(),
                            'estado' => $estado->getId()));
            } else {
                $inscripcionesProyecto = $this->em->getRepository('Proyectos\Model\Entity\InscripcionProyecto')->findBy(
                        array(
                            'estado' => $estado->getId()));
            }
            if ($this->isAjax()) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_ARCHIVE, array(
                    'inscripcionesProyecto' => $inscripcionesProyecto,
                ));
            }
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
                throw new NotFoundEntityException('Inscripcion Proyecto');
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


            $this->bind($inscripcionProyecto);
            $this->em->persist($inscripcionProyecto);
            $this->em->flush();

            if ($this->isAjax()) {
                
            } else {
                View::render(INSCRIPCION_PROYECTO_EDIT, array(
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findBy(array('ambito' => 'proyecto')),
                    'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                    'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findBy(array('ambito' => 'INSCRIPCIONPROYECTO')),
                    'mensajesExito' => array('Datos actualizada con exito.'),
                    'inscripcionProyecto' => $inscripcionProyecto,
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(INSCRIPCION_PROYECTO_EDIT, array(
                'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findBy(array('ambito' => 'proyecto')),
                'personas' => $this->em->getRepository('Personas\Model\Entity\Persona')->findActivos(),
                'proyectos' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findActivos(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findBy(array('ambito' => 'INSCRIPCIONPROYECTO')),
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

            $descripcionActividad = isset($_POST['descripcionActividad']) ? $_POST['descripcionActividad'] : '';
            $idEstado = isset($_POST['estado']) ? $_POST['estado'] : -1;
            $idRolProyecto = isset($_POST['rol']) ? $_POST['rol'] : -1;
            //$idUsuario = isset($_POST['usuario']) ? $_POST['usuario'] : -1;
            $idPersona = isset($_POST['persona']) ? $_POST['persona'] : -1;
            $idProyecto = isset($_POST['proyecto']) ? $_POST['proyecto'] : -1;


            $rolProyecto = $idRolProyecto != -1 ? $this->em->getRepository('Administracion\Model\Entity\Rol')->find($idRolProyecto) :
                    $this->em->getRepository('Administracion\Model\Entity\Rol')->findOneBy(array(
                        'nombre' => 'participante',
                        'ambito' => 'proyecto'
            ));
            $persona = $this->em->getRepository('Personas\Model\Entity\Persona')->find($idPersona);
            if (is_null($persona) && is_null($_SESSION['usuario']->getPersona())) {
                throw new \Exception('Completa tus datos personales');
            } else if (is_null($persona) && !is_null($_SESSION['usuario']->getPersona())) {
                $persona = $_SESSION['usuario']->getPersona();
            }

            $proyecto = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->find($idProyecto);
            if (is_null($proyecto))
                throw new NotFoundEntityException('Proyecto');
            $estado = $idEstado != -1 ? $this->em->getRepository('Administracion\Model\Entity\Estado')->find($idEstado) :
                    $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array('nombre' => 'PENDIENTE', 'ambito' => 'INSCRIPCIONPROYECTO'));

            /* if ($id != '-1')
              $inscripcionProyecto->setId($id); */
            $inscripcionProyecto->setProyecto($proyecto);
            if (is_null($inscripcionProyecto->getId()))
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
