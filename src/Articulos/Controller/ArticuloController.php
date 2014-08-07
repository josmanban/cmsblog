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
use Librerias\Conexion;
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

    private $savePathPhoto;
    private $pathPhoto;
    private $em;

    function __construct() {
        $this->em = Conexion::getEntityManager();
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
            $this->em->persist($articulo);
            $this->em->flush();

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(ARTICULO_NEW, array(
                    'mensajesExito' => array('Articulo creado con éxito.'),
                    'categorias' => $this->em->getRepository('Articulos\Model\Entity\CategoriaArticulo')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(ARTICULO_NEW, array(
                'errores' => $ex->getErrores(),
                'categorias' => $this->em->getRepository('Articulos\Model\Entity\CategoriaArticulo')->findActivos(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
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
            $articulo = $this->em->getRepository('Articulos\Model\Entity\Articulo')->find($id);
            if (is_null($articulo))
                throw new NotFoundEntityException('articulo');
            if (!($usuario->esPublicador() && $articulo->esAutor($usuario)) && !$usuario->esAdministrador() && !$usuario->esAdministradorArticulo())
                throw new NotAllowedException();

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(ARTICULO_EDIT, array(
                    'categorias' => $this->em->getRepository('Articulos\Model\Entity\CategoriaArticulo')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
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

            $numItems = $this->em->contarTodos(null);
            $criteria = [];
            $paginator = new Paginator('articulo', 'index', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $criteria);

            $articulos = $this->em->getRepository()->findBy(
                    $criteria, array('id' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
            );


            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(ARTICULO_INDEX, array(
                    'articulos' => $articulos,
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
                    'categorias' => $this->em->getRepository('Articulos\Model\Entity\CategoriaArticulo')->findActivos(),
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

            if (!isset($_GET['id']))
                throw new NotFoundEntityException();
            $idArticulo = $_GET['id'];
            $articulo = $this->em->getRepository('Articulos\Model\Entity\Articulo')->find($idArticulo);

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
            $articulo = $this->em->getRepository('Articulos\Model\Entity\Articulo')->find($idArticulo);
            if (is_null($articulo))
                throw new NotFoundEntityException();
            if (!($usuario->esPublicador() && $articulo->esAutor($usuario)) && !$usuario->esAdministrador() && !$usuario->esAdministradorArticulo())
                throw new NotAllowedException();

            $this->validate($articulo);

            $this->em->persist($articulo);
            $this->em->flush();

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(ARTICULO_EDIT, array(
                    'mensajesExito' => array('Articulo editado con éxito.'),
                    'categorias' => $this->em->getRepository('Articulos\Model\Entity\CategoriaArticulo')->findActivos(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                    'articulo' => $articulo,
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(ARTICULO_EDIT, array(
                'errores' => $ex->getErrores(),
                'categorias' => $this->em->getRepository('Articulos\Model\Entity\CategoriaArticulo')->findActivos(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                'articulo' => $this->em->getRepository('Articulos\Model\Entity\Articulo')->find($_POST['id']),
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

                $numItems = $this->em->contarTodos(null);
                $criteria = [];
                $paginator = new Paginator('articulo', 'portada', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $criteria);

                $articulos = $this->em->getRepository()->findBy(
                        $criteria, array('id' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
                );

                view::render(ARTICULO_PORTADA, array(
                    'articulos' => $articulos,
                    'paginator' => $paginator,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function bind($articulo = null) {
        if (is_null($articulo))
            $articulo = new Articulo();

        $id = $_POST['id'];
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
        $texto = isset($_POST['texto']) ? $_POST['texto'] : '';

        $idEstado = isset($_POST['estado']) ? $_POST['estado'] : '-1';
        $estado = ($idEstado == '-1') ?
                $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array('nombre' => 'ACTIVO')) :
                $thils->em->getRepository('Administracion\Model\Entity\Estado')->find($idEstado);
        $idCategorias = (isset($_POST['categorias'])) ? $_POST['categorias'] : [];

        $categorias = [];
        foreach ($idCategorias as $idCategoria) {
            $categoria = $this->em->getRepository('Administracion\Model\Entity\CategoriaArticulo')->find($idCategoria);
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
