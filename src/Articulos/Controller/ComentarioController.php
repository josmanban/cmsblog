<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Articulos\Controller;

use Librerias\Controller;
use Librerias\View;
use Librerias\Paginator;
use Librerias\Constantes;
use Articulos\Model\Articulo;
use Articulos\Model\CategoriaArticulo;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\NotFoundEntityException;
use Librerias\InvalidEntityException;
use Librerias\MissingParametersException;
use Librerias\Conexion;
use Administracion\Model\Estado;
use Administracion\Model\Rol;
use Administracion\Model\Usuario;
use Articulos\Model\Comentario;
use Articulos\Validator\ComentarioValidator;

class ComentarioController extends Controller {

    private $em;
    function __construct() {
        $this->em= Conexion::getEntityManager();
    }

    public function createAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            $idPost = isset($_POST['post']) ? $_POST['post'] : -1;
            $post = $this->em->getRepository('Articulos\Model\Entity\Post')->find($idPost);
            if (is_null($post))
                throw new NotFoundEntityException();
            $comentario = $this->validate();
            
            $this->em->persist($comentario);
            $post->addComentario($comentario);
            $this->em->flush();                  

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(COMENTARIO_NEW, array(
                    'mensajesExito' => array('Comentario creado con exito'),
                    'post' => $post,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    public function deleteAction() {
        
    }

    public function editAction() {
        
    }

    public function indexAction() {
        
    }

    public function newAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!isset($_GET['post']))
                throw new \Librerias\MissingParametersException(['post']);
            $post = $this->em->getRepository('Articulos\Model\Entity\Post')->find($_GET['post']);

            if (is_null($post))
                throw new NotFoundEntityException();
            $padre = isset($_GET['padre']) ?
                $this->getRepository('Articulos\Model\Entity\Comentario')->find($_GET['padre']) : 
                null;

            if (isset($_REQUEST['ajax'])) {
                require_once dirname(__FILE__) . '/../Views/Comentario/newForm.html.php';
            } else {
                require_once dirname(__FILE__) . '/../Views/Comentario/new.html.php';
                ;
            }
        } catch (\Exception $ex) {
            $errores = [$ex->getMessage()];
            require_once dirname(__FILE__) . '/../../Templates/error.html.php';
        }
    }

    public function showAction() {
        
    }

    public function updateAction() {
        
    }

    public function bind($comentario = null) {
        if (is_null($comentario))
            $comentario = new Comentario();
        $id = $_POST['id'];
        $idPost = isset($_POST['post']) ? $_POST['post'] : -1;
        $idPadre = isset($_POST['padre']) ? $_POST['padre'] : -1;

        $texto = isset($_POST['texto']) ? $_POST['texto'] : '';

        $post = $this->em->getRepository('Articulos\Model\Entity\Post')->find($idPost);
        $padre = $this->em->getRepository('Articulos\Model\Entity\Comentario')->find($idPadre);

        $estadoActivo = $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array('nombre'=>'ACTIVO'));

        //$comentario->setId($id);
        $comentario->setTexto($texto);
        $comentario->setPadre($padre);
        $comentario->setPost($post);
        if ($comentario->getId() == -1) {
            $comentario->setUsuario($_SESSION['usuario']);
            $comentario->setFechaHora(new \DateTime());
        }
        $comentario->setEstado($estadoActivo);

        $validator = new ComentarioValidator($comentario);
        $validator->validate();

        return $comentario;
    }

}

?>
