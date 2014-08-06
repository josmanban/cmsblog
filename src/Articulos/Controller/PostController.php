<?php

namespace Articulos\Controller;

use Librerias\Controller;
use Articulos\Model\PostAccesoDatos;
use Librerias\NotFoundEntityException;
use Articulos\Model\PostNegocio;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostController
 *
 * @author jose
 */
abstract class PostController extends Controller {

    //put your code here

    public function getCommentsBoxAction($id = null) {
        if (!is_null($id)) {
            $postAccesoDatos = new PostAccesoDatos();
            $post = $postAccesoDatos->consultarPorId($id);
            if (!is_null($post)) {
                require COMENTARIO_NEW_FORM;
                $this->showCommentsAction($id);
            }
        }
    }

    /*
     * Renderiza los comentarios de un articulo
     * 
     */

    public function showCommentsAction($idPost = null) {
        try {
            if (is_null($idPost)) {
                if (isset($_REQUEST['id'])) {
                    $idPost = $_REQUEST['id'];
                    $postAccesoDatos = new PostAccesoDatos();
                    $post = $postAccesoDatos->consultarPorId($idPost);
                    if (is_null($post))
                        ;
                    throw new NotFoundEntityException('Post');
                }
                else
                    throw new MissingParametersException(array('Id post'));
            }
            PostNegocio::mostrarComentarios($idPost);
        } catch (Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

}

?>
