<?php

namespace Administracion\Controller;

use Librerias\Controller;
use Librerias\View;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\InvalidEntityException;
use Librerias\InvalidFormDataException;
use Librerias\Paginator;
use Librerias\Validator;
use Librerias\Conexion;
use Administracion\Model\Entity\Estado;
use Administracion\Model\Entity\Rol;
use Administracion\Model\Entity\Usuario;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of UsuarioController
 *
 * @author jose
 */

class PerfilController extends Controller {

    //entity manager
    private $em;

    function __construct() {
        $this->em = Conexion::getEntityManager();
    }

    //put your code here
    public function createAction() {
        try {
            $loguedUser = $_SESSION['usuario'];
            if (is_null($loguedUser))
                throw new NotLoggedException($ex);
            $perfil = $loguedUser->getPerfil();
            if (!$loguedUser->esAdministrador() && !is_null($perfil))
                throw new NotAllowedException();
            $perfil = $this->validate();

            $this->em->persist($perfil);
            $this->em->flush();
        } catch (\Librerias\InvalidaFormDataException $ex) {
            View::render(PERFIL_NEW, array(
                'errores' => $ex->getErrores(),
                'usuarios' => $this->em->getRepository('Administracion\Model\Entity\Usuario')->findActivos(),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function deleteAction() {
        
    }

    public function editAction() {
        try {
            
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function indexAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!$usuario->esAdministrador())
                throw new NotAllowedException();

            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;

            $numItems = $this->em->contarTodos(null);
            $parameters = [];
            $paginator = new Paginator('persona', 'index', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $parameters);
            $parameters[] = [ 'offset' => $paginator->getOffset()];
            $parameters[] = ['limit' => $paginator->getLimit()];

            //$personas = $this->personaAccesoDatos->consultarTodos($parameters);

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                // require_once dirname(__FILE__) . '/../Views/Persona/index.html.php';
                View::render(PERFIL_INDEX, array(
                    'perfiles' => $this->em->consultarTodos($parameters),
                    'paginator' => $paginator,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function newAction() {
        try {
            
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function showAction() {
        
    }

    public function updateAction() {
        try {
            
        } catch (InvalidFormDataException $ex) {
            View::render(PERFIL_EDIT, array(
                'errores' => $ex->getErrores(),
                'usuario' => $this->em->find($_POST['id']),
                'roles' => $this->em->getRepository()->findActivos(),
                'estados' => $this->em->getRepository()->findAll())
            );
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    //valida creacion y edicion
    public function bind($perfil = null) {
        try {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

            return $perfil;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}

?>
