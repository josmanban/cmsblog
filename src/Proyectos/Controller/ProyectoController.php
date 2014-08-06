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
use Administracion\Model\UsuarioAccesoDatos;
use Administracion\Model\Estado;
use Administracion\Model\EstadoAccesoDatos;
use Administracion\Model\Rol;
use Administracion\Model\RolAccesoDatos;
use Administracion\Model\Usuario;
use Administracion\FacadeAdministracion;
use Proyectos\Model\TipoProyectoAccesoDatos;
use Proyectos\Model\Proyecto;
use Proyectos\Model\ProyectoAccesoDatos;
use Articulos\Controller\ArticuloController;
use Articulos\FacadeArticulos;
use Proyectos\Validator\ProyectoValidator;
use Librerias\InvalidFormDataException;
use Proyectos\Model\InscripcionProyectoAccesoDatos;
use Articulos\Model\PostNegocio;
use Articulos\Controller\PostController;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectoController
 *
 * @author jose
 */
class ProyectoController extends PostController {

    private $proyectoAccesoDatos;
    private $inscripcionProyectoAccesoDatos;
    private $tipoProyectoAccesoDatos;

    function __construct() {
        $this->proyectoAccesoDatos = new ProyectoAccesoDatos();
        $this->tipoProyectoAccesoDatos = new TipoProyectoAccesoDatos();
        $this->inscripcionProyectoAccesoDatos = new InscripcionProyectoAccesoDatos();
        $this->showViewPath = PROYECTO_SHOW;
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
            $proyecto = $this->validate();
            $this->proyectoAccesoDatos->insertar($proyecto);

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(PROYECTO_NEW, array(
                    'mensajesExito' => array('Proyecto creado con éxito.'),
                    'tipos' => $this->tipoProyectoAccesoDatos->consultarActivos(),
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                  
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(PROYECTO_NEW, array(
                'errores' => $ex->getErrores(),
               
                'estados' => FacadeAdministracion::getEstadosActivos(),
                'tipos' => $this->tipoProyectoAccesoDatos->consultarActivos(),
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
            $proyecto = $this->proyectoAccesoDatos->consultarPorId($id);
            if (is_null($proyecto))
                throw new NotFoundEntityException('proyecto');
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorProyecto() &&
                    !($usuario->esPublicadorProyecto() && $proyecto->esAutor($usuario)))
                throw new NotAllowedException();

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(PROYECTO_EDIT, array(
                    'proyecto' => $proyecto,
                    'tipos' => $this->tipoProyectoAccesoDatos->consultarActivos(),
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

            $numItems = $this->proyectoAccesoDatos->contarTodos(null);
            $parameters = [];
            $paginator = new Paginator('proyecto', 'index', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $parameters);
            $parameters[] = [ 'offset' => $paginator->getOffset()];
            $parameters[] = ['limit' => $paginator->getLimit()];


            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(PROYECTO_INDEX, array(
                    'proyectos' => $this->proyectoAccesoDatos->consultarTodos($parameters),
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

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(PROYECTO_NEW, array(
                    'tipos' => $this->tipoProyectoAccesoDatos->consultarActivos(),
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

            if (!isset($_GET['id']))
                throw new MissingParametersException('id proyecto');
            $id = $_GET['id'];
            $proyecto = $this->proyectoAccesoDatos->consultarPorId($id);
            if (is_null($proyecto))
                throw new NotFoundEntityException();
            if (isset($_REQUEST['ajax'])) {
                
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
            $proyecto = $this->proyectoAccesoDatos->consultarPorId($id);
            if (is_null($proyecto))
                throw new NotFoundEntityException('proyecto');
            if (!($usuario->esPublicadorProyecto() && $proyecto->esAutor($usuario)) && !$usuario->esAdministrador() && !$usuario->esAdministradorProyecto())
                throw new NotAllowedException();

            $this->validate($proyecto);
            $this->proyectoAccesoDatos->actualizar($proyecto);

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(PROYECTO_EDIT, array(
                    'mensajesExito' => array('Datos actualizados con éxito.'),
                   
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                    'tipos' => $this->tipoProyectoAccesoDatos->consultarActivos(),
                    'proyecto' => $proyecto,
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(PROYECTO_EDIT, array(
                'errores' => $ex->getErrores(),
       
                'estados' => FacadeAdministracion::getEstadosActivos(),
                'tipos' => $this->tipoProyectoAccesoDatos->consultarActivos(),
                'proyecto' => $this->proyectoAccesoDatos->consultarPorId($_POST['id']),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function validate($proyecto = null) {
        try {

            if (is_null($proyecto))
                $proyecto = new Articulo();

            $id = $_POST['id'];
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
            $texto = isset($_POST['texto']) ? $_POST['texto'] : '';
            $idEstado = isset($_POST['estado']) ? $_POST['estado'] : '-1';
            $estado = ($idEstado == '-1') ? FacadeAdministracion::getEstadoPorNombre('activo') : FacadeAdministracion::getEstadoPorId($idEstado);
            


            $idTipo = isset($_POST['tipo']) ? $_POST['titulo'] : '-1';
            $tipo = ($idTipo == '-1') ? $this->tipoProyectoAccesoDatos->consultarPorId($idTipo) : $this->tipoProyectoAccesoDatos->consultarNombre('desarrollo');
            $cupo = isset($_POST['cupo']) ? $_POST['cupo'] : 30;
            $version = isset($_POST['version']) ? $_POST['version'] : '0.0.1';
            $codename = isset($_POST['codename']) ? $_POST['codename'] : 'C.O.D.E.N.A.M.E';
            $fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : '';
            $duracionMeses = isset($_POST['duracionMeses']) ? $_POST['duracionMeses'] : '';

         

            $proyecto->setId($id);
            $proyecto->setTitulo($titulo);
            $proyecto->setTexto($texto);

            $proyecto->setEstado($estado);           
            if ($proyecto->getId() == -1) {
                $proyecto->setFechaHoraPublicacion(new \DateTime);
                $proyecto->setPublicador($_SESSION['usuario']);
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
                FuncionesVarias::saveImage(POST_IMAGE_SAVE_PATH . PostNegocio::buildPostImageName($proyecto->getId(), $extension), 'imagen');
                $proyecto->setImagen(POST_IMAGE_URL . PostNegocio::buildPostImageName($proyecto->getId(), $extension));
            }
            return $proyecto;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function archiveAction() {
        try {
            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;

            $numItems = $this->proyectoAccesoDatos->contarTodos(null);
            $parameters = [];
            if (isset($_REQUEST['tipoProyecto'])) {
                $parameters['tipoProyecto'] = $_REQUEST['tipoProyecto'];
            }

            $paginator = new Paginator('proyecto', 'archive', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $parameters);
            $parameters[] = [ 'offset' => $paginator->getOffset()];
            $parameters[] = ['limit' => $paginator->getLimit()];

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(PROYECTO_ARCHIVE, array(
                    'proyectos' => $this->proyectoAccesoDatos->consultarTodos($parameters),
                    'paginator' => $paginator,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function getCommentsBoxAction($id = null) {
        $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
        if (!is_null($usuario)) {
            $inscripcion = $this->inscripcionProyectoAccesoDatos->consultarPorIdProyectoIdUsuario($id, $usuario->getId());
            if (!is_null($inscripcion) || $usuario->esAdmnistrador() || $usuario->esAdministradorProyectos())
                parent::getCommentsBoxAction($id);
        }
    }

}

?>
