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
use Librerias\MissingParametersException;
use Librerias\Conexion;
use Librerias\FuncionesVarias;
use Proyectos\Model\Entity\Proyecto;
use Proyectos\Model\Validator\ProyectoValidator;
use Librerias\InvalidFormDataException;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectoController
 *
 * @author jose
 */
class ProyectoController extends Controller {

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
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorProyecto() && !$usuario->esPublicadorProyecto())
                throw new NotAllowedException();
            $proyecto = $this->bind();
            $this->em->persist($proyecto);
            $this->em->flush();

            if ($this->isAjax()) {
                
            } else {
                View::render(PROYECTO_NEW, array(
                    'mensajesExito' => array('Proyecto creado con éxito.'),
                    'tipos' => $this->em->getRepository('Proyectos\Model\Entity\TipoProyecto')->findAll(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll()
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(PROYECTO_NEW, array(
                'errores' => $ex->getErrores(),
                'tipos' => $this->em->getRepository('Proyectos\Model\Entity\TipoProyecto')->findAll(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll()
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
            $proyecto = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->find($id);
            if (is_null($proyecto))
                throw new NotFoundEntityException('proyecto');
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorProyecto() &&
                    !($usuario->esPublicadorProyecto() && $proyecto->esAutor($usuario)))
                throw new NotAllowedException();

            if ($this->isAjax()) {
                
            } else {
                View::render(PROYECTO_EDIT, array(
                    'proyecto' => $proyecto,
                    'tipos' => $this->em->getRepository('Proyectos\Model\Entity\TipoProyecto')->findAll(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll()
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
            $numItems = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->contar($criteria);
            $paginator = new Paginator('proyecto', 'index', $page, ITEMS_X_PAGE_INDEX, $numItems, $criteria);
            $proyectos = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findBy(
                    $criteria, array('id' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
            );


            if ($this->isAjax()) {
                
            } else {
                View::render(PROYECTO_INDEX, array(
                    'proyectos' => $proyectos,
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
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorProyecto() && !$usuario->esPublicadorProyecto())
                throw new NotAllowedException();

            if ($this->isAjax()) {
                
            } else {
                View::render(PROYECTO_NEW, array(
                    'tipos' => $this->em->getRepository('Proyectos\Model\Entity\TipoProyecto')->findAll(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll()
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

            if (!isset($_GET['id']))
                throw new MissingParametersException('id proyecto');
            $id = $_GET['id'];
            $proyecto = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->find($id);
            if (is_null($proyecto))
                throw new NotFoundEntityException();
            if ($this->isAjax()) {
                
            } else {
                View::render(PROYECTO_SHOW, array(
                'proyecto' => $proyecto,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
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
            $proyecto = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->find($id);
            if (is_null($proyecto))
                throw new NotFoundEntityException('proyecto');
            if (!($usuario->esPublicadorProyecto() && $proyecto->esAutor($usuario)) && !$usuario->esAdministrador() && !$usuario->esAdministradorProyecto())
                throw new NotAllowedException();

            $this->bind($proyecto);
            $this->em->persist($proyecto);
            $this->em->flush();

            if ($this->isAjax()) {
                
            } else {
                View::render(PROYECTO_EDIT, array(
                    'mensajesExito' => array('Datos actualizados con éxito.'),
                    'tipos' => $this->em->getRepository('Proyectos\Model\Entity\TipoProyecto')->findAll(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                    'proyecto' => $proyecto,
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(PROYECTO_EDIT, array(
                'errores' => $ex->getErrores(),
                'tipos' => $this->em->getRepository('Proyectos\Model\Entity\TipoProyecto')->findAll(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                'proyecto' => $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->find($_POST['id']),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function archiveAction() {
        try {
            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;


            $criteria = [];
            if (isset($_REQUEST['tipo'])) {
                $criteria['tipo'] = $_REQUEST['tipo'];
            }
            $numItems = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->contar($criteria);
            $paginator = new Paginator('proyecto', 'index', $page, ITEMS_X_PAGE_INDEX, $numItems, $criteria);

            $proyectos = $this->em->getRepository('Proyectos\Model\Entity\Proyecto')->findBy(
                    $criteria, array('id' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
            );

            if ($this->isAjax()) {
                
            } else {
                View::render(PROYECTO_ARCHIVE, array(
                    'proyectos' => $proyectos,
                    'paginator' => $paginator,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function bind($proyecto = null) {
        try {

            if (is_null($proyecto))
                $proyecto = new Proyecto();

            
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
            $texto = isset($_POST['texto']) ? $_POST['texto'] : '';
            $idEstado = isset($_POST['estado']) ? $_POST['estado'] : '-1';
            $estado = ($idEstado == '-1') ?
                    $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array('nombre' => 'ACTIVO')) : $this->em->getRepository('Administracion\Model\Entity\Estado')->find($idEstado);



            $idTipo = isset($_POST['tipo']) ? $_POST['tipo'] : '-1';
            $tipo = ($idTipo == '-1') ?
                    $this->em->getRepository('Proyectos\Model\Entity\TipoProyecto')->findOneBy(array('nombre' => 'DESARROLLO')) :
                    $this->em->getRepository('Proyectos\Model\Entity\TipoProyecto')->find($idTipo);
            $cupo = isset($_POST['cupo']) ? $_POST['cupo'] : 30;
            $version = isset($_POST['version']) ? $_POST['version'] : '0.0.1';
            $codename = isset($_POST['codename']) ? $_POST['codename'] : 'C.O.D.E.N.A.M.E';
            $fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : '';
            $duracionMeses = isset($_POST['duracionMeses']) ? $_POST['duracionMeses'] : '';


            //$proyecto->setId($id);
            $proyecto->setTitulo($titulo);
            $proyecto->setTexto($texto);

            $proyecto->setEstado($estado);


            if (is_null($proyecto->getId())) {
                $proyecto->setFechaHoraPublicacion(new \DateTime());
                $proyecto->setAutor($_SESSION['usuario']);
            }

            $proyecto->setTipo($tipo);
            $proyecto->setFechaInicio($fechaInicio);
            $proyecto->setDuracionMeses($duracionMeses);
            $proyecto->setCupo($cupo);
            $proyecto->setVersion($version);
            $proyecto->setCodename($codename);



            $validator = new ProyectoValidator($proyecto);
            $validator->validate();

            /*             * *** actualizo la imagen de haberla********* */
            if (!empty($_FILES['imagen']['name'])) {
                $temp = explode(".", $_FILES['imagen']["name"]);
                $extension = end($temp);
                if (is_null($proyecto->getId()))
                    $nextId = $this->em->getRepository('Articulos\Model\Entity\Post')->findNextId();
                else
                    $nextId = $proyecto->getId();
                FuncionesVarias::saveImage(POST_IMAGE_SAVE_PATH . 'post' . $nextId . '.' . $extension, 'imagen');
                $proyecto->setImagen(POST_IMAGE_URL . 'post' . $nextId . '.' . $extension);
            }
            return $proyecto;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

?>
