<?php

namespace Articulos\Model;

use Articulos\Model\PostAccesoDatos;
use Articulos\Model\ComentarioAccesoDatos;
use Articulos\Model\Post;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectoNegocio
 *
 * @author jose
 */
class PostNegocio {

    //put your code here
    public static function buildPostImageName($idEntity, $extension) {
        if ($idEntity == '-1') {
            $postAccesoDatos = new PostAccesoDatos();
            $idEntity = $postAccesoDatos->consultarUltimoId();
        }
        return $idEntity . '.' . $extension;
    }

    /*
     * Funcion recursiva que imprime los cometarios de un articulo.
     */

    public static function mostrarComentarios($idPost, $comentarioPadre = null, $comentarioAccesoDatos = null, $level = ARTICULOS_LEVEL_COMMENTS) {
        try {
            if (!is_null($comentarioPadre)) {
                $comentario = $comentarioPadre;
                echo '<li style="list-style:none;">';
                require COMENTARIO_SHOW;
            }
            if (is_null($comentarioAccesoDatos))
                $comentarioAccesoDatos = new ComentarioAccesoDatos();
            $idPadre = is_null($comentarioPadre) ? null : $comentarioPadre->getId();
            $comentariosHijos = $comentarioAccesoDatos->consultarPorPadre($idPost, $idPadre);
            if (is_null($comentariosHijos) || count($comentariosHijos) == 0) {
                echo '</li>';
                return;
            }
            if ($level > 0)
                echo '<ul>';
            foreach ($comentariosHijos as $comentarioHijo) {
                self::mostrarComentarios($idPost, $comentarioHijo, $comentarioAccesoDatos, $level - 1);
            }
            if (!is_null($comentarioPadre))
                echo '</li>';
            if ($level > 0)
                echo '</ul>';
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}

?>
