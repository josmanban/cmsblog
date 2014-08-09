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
use Librerias\Conexion;

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
            //$usuario = Conexion::getEntityManager()->getRepository(
              //              'Administracion\Model\Entity\Usuario')->find($_SESSION['usuario']->getId());
            /* $b= $a->getRoles();
              $c= 0;
              foreach ($b as $rol){
              $c++;
              } */

            if (!$usuario->esAdministrador() && !$usuario->esAdministradorArticulo() && !$usuario->esAdministradorProyecto() && !$usuario->esPublicador() && !$usuario->esPublicadorProyecto())
                throw new NotAllowedException();
            View::render(PAGINA_ADMIN, array(
                'usuario'=>$usuario
            ));
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

    public function bind($entity = null) {
        
    }

}

?>