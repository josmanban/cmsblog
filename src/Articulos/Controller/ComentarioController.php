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
use Articulos\Model\Entity\Comentario;
use Articulos\Model\Validator\ComentarioValidator;

class ComentarioController extends Controller {

    private $em;

    function __construct() {
        $this->em = Conexion::getEntityManager();
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
            $comentario = $this->bind();

            $this->em->persist($comentario);

            $post->addComentario($comentario);
            $usuario->addComentario($comentario);
            $this->em->flush();

            if ($this->isAjax()) {
                echo json_encode(array(
                    'mensaje' => 'Comentario agregado¡¡'
                ));
                die();
            } else {
                View::render(COMENTARIO_NEW, array(
                    'mensajesExito' => array('Comentario creado con exito'),
                    'post' => $post,
                ));
            }
        } catch (\Librerias\InvalidFormDataException $ex) {
            if ($this->isAjax()) {
                echo json_encode(array('errores' => $ex->getErrores()));
                die();
            }
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        } catch (\Exception $ex) {
            if ($this->isAjax()) {
                echo json_encode(array('errores' => $ex->getMessage()));
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
        
    }

    public function indexAction() {
        
    }

    public function treeAction() {
        try {
            if (!isset($_GET['id']))
                throw new NotFoundEntityException('Post');
            $comentarios = $this->em->getRepository('Articulos\Model\Entity\Comentario')->findCommentariosOrderByDate(
                    $_GET['id']);

            if ($this->isAjax()) {
                View::render(COMENTARIO_TREE, array(
                    'comentarios' => $comentarios,
                    'conId' => true,
                ));
            }
            return;
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
            if (!isset($_GET['post']))
                throw new \Librerias\MissingParametersException(['post']);
            $post = $this->em->getRepository('Articulos\Model\Entity\Post')->find($_GET['post']);

            if (is_null($post))
                throw new NotFoundEntityException();
            $padre = isset($_GET['padre']) ?
                    $this->em->getRepository('Articulos\Model\Entity\Comentario')->find($_GET['padre']) :
                    null;

            if ($this->isAjax()) {
                View::render(COMENTARIO_NEW_FORM, array(
                    'autor' => $usuario,
                    'post' => $post,
                    'padre' => $padre,
                ));
            } else {
                View::render(COMENTARIO_NEW, array(
                    'autor' => $usuario,
                    'post' => $post,
                    'padre' => $padre,
                ));
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
        //$id = $_POST['id'];
        $idPost = isset($_POST['post']) ? $_POST['post'] : -1;
        $idPadre = isset($_POST['padre']) ? $_POST['padre'] : -1;

        $texto = isset($_POST['texto']) ? $_POST['texto'] : '';

        $post = $this->em->getRepository('Articulos\Model\Entity\Post')->find($idPost);
        $padre = $this->em->getRepository('Articulos\Model\Entity\Comentario')->find($idPadre);

        $estadoActivo = $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array('nombre' => 'ACTIVO'));

        $comentario->setTexto($texto);
        $comentario->setPadre($padre);
        $comentario->setPost($post);
        if (is_null($comentario->getId())) {
            $comentario->setFechaHora(new \DateTime());
            $comentario->setAutor($_SESSION['usuario']);
        }
        $comentario->setEstado($estadoActivo);

        $validator = new ComentarioValidator($comentario);
        $validator->validate();

        return $comentario;
    }

}

?>
