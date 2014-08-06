<?php

namespace Articulos\Controller;

use Librerias\Controller;
use Librerias\View;
use Librerias\Paginator;
use Librerias\Constantes;
use Articulos\Model\ArticuloAccesoDatos;
use Articulos\Model\Articulo;
use Articulos\Model\CategoriaArticulo;
use Articulos\Model\CategoriaArticuloAccesoDatos;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\NotFoundEntityException;
use Librerias\InvalidFormDataException;
use Librerias\MissingParametersException;
use Librerias\FuncionesVarias;
use Administracion\Model\UsuarioAccesoDatos;
use Administracion\Model\Estado;
use Administracion\Model\EstadoAccesoDatos;
use Administracion\Model\Rol;
use Administracion\Model\RolAccesoDatos;
use Administracion\Model\Usuario;
use Administracion\FacadeAdministracion;
use Articulos\Model\ComentarioAccesoDatos;
use Articulos\Validator\ArticuloValidator;
use Articulos\Model\PostNegocio;

/* To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticuloController
 *
 * @author jose
 */
class ArticuloController extends PostController {

    private $comentarioAccesoDatos;
    private $categoriaArticuloAccesoDatos;
    private $articuloAccesoDatos;
    private $savePathPhoto;
    private $pathPhoto;
    protected $showViewPath;

    function __construct() {
        $this->showViewPath = ARTICULO_SHOW;

        $this->comentarioAccesoDatos = new ComentarioAccesoDatos();
        $this->categoriaArticuloAccesoDatos = new CategoriaArticuloAccesoDatos();
        $this->articuloAccesoDatos = new ArticuloAccesoDatos();

        $this->savePathPhoto = dirname(__DIR__) . '/../../img/Articulo/imagen/';
        $this->pathPhoto = SITE_URL . '/img/Articulo/imagen/';
    }

    //put your code here
    public function createAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!$usuario->esPublicador() && !$usuario->esAdministrador() && !$usuario->esAdministradorArticulo())
                throw new NotAllowedException();

            $articulo = $this->validate();
            $this->articuloAccesoDatos->insertar($articulo);

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(ARTICULO_NEW, array(
                    'mensajesExito' => array('Articulo creado con éxito.'),
                    'categorias' => $this->categoriaArticuloAccesoDatos->consultarActivas(),
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(ARTICULO_NEW, array(
                'errores' => $ex->getErrores(),
                'categorias' => $this->categoriaArticuloAccesoDatos->consultarActivas(),
                'estados' => FacadeAdministracion::getEstadosActivos(),
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
                throw new MissingParametersException('id articulo');

            $id = $_GET['id'];
            $articulo = $this->articuloAccesoDatos->consultarPorId($id);
            if (is_null($articulo))
                throw new NotFoundEntityException('articulo');
            if (!($usuario->esPublicador() && $articulo->esAutor($usuario)) && !$usuario->esAdministrador() && !$usuario->esAdministradorArticulo())
                throw new NotAllowedException();

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(ARTICULO_EDIT, array(
                    'categorias' => $this->categoriaArticuloAccesoDatos->consultarActivas(),
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                    'articulo' => $articulo,
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
            if (!$usuario->esPublicador())
                throw new NotAllowedException();



            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;

            $numItems = $this->articuloAccesoDatos->contarTodos(null);
            $parameters = [];
            $paginator = new Paginator('articulo', 'index', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $parameters);
            $parameters[] = [ 'offset' => $paginator->getOffset()];
            $parameters[] = ['limit' => $paginator->getLimit()];

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(ARTICULO_INDEX, array(
                    'articulos' => $this->articuloAccesoDatos->consultarTodos($parameters),
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
            if (!$usuario->esPublicador() && !$usuario->esAdministrador() && !$usuario->esAdministradorArticulo())
                throw new NotAllowedException();

            if (isset($_POST['ajax']) || isset($_GET['ajax'])) {
                
            } else {
                View::render(ARTICULO_NEW, array(
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                    'categorias' => $this->categoriaArticuloAccesoDatos->consultarActivas(),
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
                throw new NotFoundEntityException();
            $idArticulo = $_GET['id'];

            $articulo = $this->articuloAccesoDatos->consultarPorId($idArticulo);
            if (is_null($articulo))
                throw new NotFoundEntityException();

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(ARTICULO_SHOW, array(
                    'articulo' => $articulo,
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
            $idArticulo = $_POST['id'];
            $articulo = $this->articuloAccesoDatos->consultarPorId($idArticulo);
            if (is_null($articulo))
                throw new NotFoundEntityException();
            if (!($usuario->esPublicador() && $articulo->esAutor($usuario)) && !$usuario->esAdministrador() && !$usuario->esAdministradorArticulo())
                throw new NotAllowedException();

            $this->validate($articulo);
            $this->articuloAccesoDatos->actualizar($articulo);

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(ARTICULO_EDIT, array(
                    'mensajesExito' => array('Articulo editado con éxito.'),
                    'categorias' => $this->categoriaArticuloAccesoDatos->consultarActivas(),
                    'estados' => FacadeAdministracion::getEstadosActivos(),
                    'articulo' => $articulo,
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(ARTICULO_EDIT, array(
                'errores' => $ex->getErrores(),
                'categorias' => $this->categoriaArticuloAccesoDatos->consultarActivas(),
                'estados' => FacadeAdministracion::getEstadosActivos(),
                'articulo' => $this->articuloAccesoDatos->consultarPorId($_POST['id']),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function portadaAction() {
        try {
            if (isset($_GET['ajax'])) {
                //respuesta ajax
            } else {
                //respuesta http
                if (isset($_GET['page']))
                    $page = $_GET['page'];
                else
                    $page = 1;
                $numItems = $this->articuloAccesoDatos->contarTodos(null);
                $parameters = [];
                $paginator = new Paginator('articulo', 'portada', $page, Constantes::ITEMS_X_PAGE_VIEWS, $numItems, $parameters);
                $parameters[] = [ 'offset' => $paginator->getOffset()];
                $parameters[] = ['limit' => $paginator->getLimit()];
                view::render(ARTICULO_PORTADA, array(
                    'articulos' => $this->articuloAccesoDatos->consultarTodos($parameters),
                    'paginator' => $paginator,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function validate($articulo = null) {
        if (is_null($articulo))
            $articulo = new Articulo();

        $id = $_POST['id'];
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
        $texto = isset($_POST['texto']) ? $_POST['texto'] : '';

        $idEstado = isset($_POST['estado']) ? $_POST['estado'] : '-1';
        $estado = ($idEstado == '-1') ? FacadeAdministracion::getEstadoPorNombre('activo') : FacadeAdministracion::getEstadoPorId($idEstado);
        $idCategorias = (isset($_POST['categorias'])) ? $_POST['categorias'] : [];

        $categorias = [];
        foreach ($idCategorias as $idCategoria) {
            $categoria = $this->categoriaArticuloAccesoDatos->consultarPorId($idCategoria);
            $categorias[] = $categoria;
        }

        $articulo->setId($id);
        $articulo->setTitulo($titulo);
        $articulo->setTexto($texto);

        $articulo->setEstado($estado);
        $articulo->setCategorias($categorias);
        if ($articulo->getId() == -1) {
            $articulo->setFechaHoraPublicacion(new \DateTime);
            $articulo->setPublicador($_SESSION['usuario']);
        }
        

        $validator = new ArticuloValidator($articulo);

        $validator->validate();

        /*         * *** actualizo la imagen de haberla********* */
        if (!empty($_FILES['imagen']['name'])) {
            $temp = explode(".", $_FILES['imagen']["name"]);
            $extension = end($temp);
            FuncionesVarias::saveImage(POST_IMAGE_SAVE_PATH . PostNegocio::buildPostImageName($articulo->getId(), $extension), 'imagen');
            $articulo->setImagen(POST_IMAGE_URL . PostNegocio::buildPostImageName($articulo->getId(), $extension));
        }
        return $articulo;
    }

    

}

?>
