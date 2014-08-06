<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

namespace Paginas\Controller;

use Librerias\Controller;
use Librerias\View;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioController
 *
 * @author jose
 */
class PaginaController extends Controller {

    public function createAction() {
        
    }

    public function editAction() {
        
    }

    public function indexAction() {
        
    }

    public function newAction() {
        
    }

    public function showAction() {
        
    }

    public function validate() {
        
    }

    public function portadaAction() {
        View::render(PAGINA_PORTADA, NULL);
    }

    public function adminAction() {
        try {
            if (!isset($_SESSION['usuario']))
                throw new NotLoggedException();
            $usuario = $_SESSION['usuario'];
            if (!$usuario->esAdministrador() && !$usuario->esAdministradorArticulo() && !$usuario->esAdministradorProyecto() && !$usuario->esPublicador() && !$usuario->esPublicadorProyecto())
                throw new NotAllowedException();
            View::render(PAGINA_ADMIN, NULL);
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function nosotrosAction() {
        View::render(PAGINA_NOSOTROS, NULL);
    }

    public function galeriaAction() {
        View::render(PAGINA_GALERIA, NULL);
    }

    public function contactoAction() {
        View::render(PAGINA_CONTACTO, null);
    }

}

?>